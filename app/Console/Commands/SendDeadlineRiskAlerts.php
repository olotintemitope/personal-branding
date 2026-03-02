<?php

namespace App\Console\Commands;

use App\Enums\ProjectStatus;
use App\Enums\TaskStatus;
use App\Mail\DeadlineRiskAlertMail;
use App\Models\Project;
use App\Services\BedrockService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDeadlineRiskAlerts extends Command
{
    protected $signature = 'app:send-deadline-risk-alerts';

    protected $description = 'Use AI to predict deadline risks and alert team leads/project managers';

    public function handle(): void
    {
        $projects = Project::where('status', ProjectStatus::InProgress)
            ->whereNotNull('end_date')
            ->with(['client', 'milestones', 'tasks.assignee', 'teamMembers', 'user'])
            ->get();

        foreach ($projects as $project) {
            $totalTasks = $project->tasks->count();
            $completedTasks = $project->tasks->where('status', TaskStatus::Completed)->count();
            $overdueTasks = $project->tasks->filter(fn ($t) => $t->due_date && $t->due_date->isPast() && $t->status !== TaskStatus::Completed);

            // Skip projects with no tasks
            if ($totalTasks === 0) {
                continue;
            }

            // Calculate team velocity metrics
            $teamVelocity = [];
            foreach ($project->teamMembers as $member) {
                $memberTasks = $project->tasks->where('assigned_to', $member->id);
                $memberCompleted = $memberTasks->where('status', TaskStatus::Completed);
                $memberOverdue = $memberTasks->filter(fn ($t) => $t->due_date && $t->due_date->isPast() && $t->status !== TaskStatus::Completed);

                $avgCompletionTime = $memberCompleted->filter(fn ($t) => $t->started_at && $t->completed_at)
                    ->map(fn ($t) => $t->started_at->diffInHours($t->completed_at))
                    ->avg();

                $acceptanceRate = $memberTasks->count() > 0
                    ? round(($memberCompleted->count() / $memberTasks->count()) * 100)
                    : 0;

                $estimateAccuracy = $memberCompleted
                    ->filter(fn ($t) => $t->estimated_hours > 0)
                    ->map(fn ($t) => $t->estimated_hours > 0 ? ($t->actual_hours / $t->estimated_hours) * 100 : 100)
                    ->avg();

                $teamVelocity[] = [
                    'name' => $member->name,
                    'role' => $member->pivot->role,
                    'total_assigned' => $memberTasks->count(),
                    'completed' => $memberCompleted->count(),
                    'overdue' => $memberOverdue->count(),
                    'acceptance_rate' => $acceptanceRate . '%',
                    'avg_completion_hours' => $avgCompletionTime ? round($avgCompletionTime, 1) : 'N/A',
                    'estimate_accuracy' => $estimateAccuracy ? round($estimateAccuracy) . '%' : 'N/A',
                ];
            }

            $projectData = [
                'project_name' => $project->title,
                'deadline' => $project->end_date->toDateString(),
                'days_remaining' => now()->diffInDays($project->end_date, false),
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks,
                'completion_rate' => round(($completedTasks / $totalTasks) * 100) . '%',
                'remaining_estimated_hours' => $project->tasks->reject(fn ($t) => $t->status === TaskStatus::Completed)->sum('estimated_hours'),
                'overdue_tasks_count' => $overdueTasks->count(),
                'team_velocity' => $teamVelocity,
                'milestones_total' => $project->milestones->count(),
                'milestones_completed' => $project->milestones->whereNotNull('completed_at')->count(),
            ];

            try {
                $service = app(BedrockService::class);
                $analysis = $service->chat(
                    <<<'PROMPT'
You are a project risk analyst. Analyze the project data and provide:

1. **Deadline Prediction** — Will the deadline be met? (YES/NO/AT RISK) with confidence percentage
2. **Risk Assessment** — What are the main risks to meeting the deadline?
3. **Team Member Analysis** — Which team members are performing well vs causing delays? Base this on their velocity, acceptance rate, and overdue tasks.
4. **Task Redistribution Suggestions** — Suggest specific task reassignments to optimize delivery. Consider each member's speed and workload.
5. **Recommended Adjustments** — What changes should be made (scope, timeline, resources)?
6. **Action Items for Team Lead** — 3-5 specific actions to take immediately

Be direct, specific, and data-driven. Use names and numbers.
PROMPT,
                    [['role' => 'user', 'content' => json_encode($projectData, JSON_PRETTY_PRINT)]],
                );

                // Email to project owner and any PMs in the team
                $recipients = collect([$project->user?->email]);

                $pms = $project->teamMembers()
                    ->wherePivot('role', 'project_manager')
                    ->pluck('email');
                $recipients = $recipients->merge($pms)->filter()->unique();

                foreach ($recipients as $email) {
                    Mail::to($email)->send(new DeadlineRiskAlertMail($project, $analysis, $projectData));
                }

                $this->info("Risk alert sent for: {$project->title}");
            } catch (\Exception $e) {
                $this->error("Failed for {$project->title}: {$e->getMessage()}");
            }
        }

        $this->info('Deadline risk alerts complete.');
    }
}
