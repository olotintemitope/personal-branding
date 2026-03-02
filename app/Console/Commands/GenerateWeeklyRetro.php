<?php

namespace App\Console\Commands;

use App\Enums\ProjectStatus;
use App\Mail\WeeklyRetroMail;
use App\Models\Project;
use App\Services\BedrockService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class GenerateWeeklyRetro extends Command
{
    protected $signature = 'app:generate-weekly-retro';

    protected $description = 'Generate AI-powered weekly retrospectives for active projects and email team leads';

    public function handle(): void
    {
        $weekAgo = now()->subWeek();

        $projects = Project::where('status', ProjectStatus::InProgress)
            ->with(['client', 'milestones', 'tasks', 'teamMembers', 'user'])
            ->get();

        foreach ($projects as $project) {
            $completedMilestones = $project->milestones()
                ->where('completed_at', '>=', $weekAgo)
                ->get();

            $completedTasks = $project->tasks()
                ->where('completed_at', '>=', $weekAgo)
                ->with('assignee')
                ->get();

            $activeTasks = $project->tasks()
                ->whereIn('status', ['in_progress', 'in_review'])
                ->with('assignee')
                ->get();

            $overdueTasks = $project->tasks()
                ->whereNotIn('status', ['completed'])
                ->where('due_date', '<', now())
                ->with('assignee')
                ->get();

            $overtimeTasks = $project->tasks()
                ->whereNotNull('estimated_hours')
                ->whereColumn('actual_hours', '>', 'estimated_hours')
                ->whereNotIn('status', ['completed'])
                ->with('assignee')
                ->get();

            // Build project data for AI
            $projectData = [
                'project_name' => $project->title,
                'client' => $project->client?->name,
                'overall_progress' => $project->completionPercentage() . '%',
                'task_progress' => $project->taskCompletionPercentage() . '%',
                'total_estimated_hours' => $project->totalEstimatedHours(),
                'total_actual_hours' => $project->totalActualHours(),
                'milestones_completed_this_week' => $completedMilestones->pluck('title')->toArray(),
                'tasks_completed_this_week' => $completedTasks->map(fn ($t) => [
                    'title' => $t->title,
                    'assignee' => $t->assignee?->name,
                    'hours_spent' => $t->actual_hours,
                    'estimated_hours' => $t->estimated_hours,
                ])->toArray(),
                'tasks_in_progress' => $activeTasks->map(fn ($t) => [
                    'title' => $t->title,
                    'assignee' => $t->assignee?->name,
                    'hours_spent' => $t->actual_hours,
                    'estimated_hours' => $t->estimated_hours,
                    'due_date' => $t->due_date?->toDateString(),
                ])->toArray(),
                'overdue_tasks' => $overdueTasks->map(fn ($t) => [
                    'title' => $t->title,
                    'assignee' => $t->assignee?->name,
                    'due_date' => $t->due_date?->toDateString(),
                    'days_overdue' => $t->due_date?->diffInDays(now()),
                ])->toArray(),
                'overtime_tasks' => $overtimeTasks->map(fn ($t) => [
                    'title' => $t->title,
                    'assignee' => $t->assignee?->name,
                    'estimated' => $t->estimated_hours,
                    'actual' => $t->actual_hours,
                ])->toArray(),
                'team_members' => $project->teamMembers->map(fn ($m) => [
                    'name' => $m->name,
                    'role' => $m->pivot->role,
                    'tasks_completed' => $completedTasks->where('assigned_to', $m->id)->count(),
                    'tasks_active' => $activeTasks->where('assigned_to', $m->id)->count(),
                    'tasks_overdue' => $overdueTasks->where('assigned_to', $m->id)->count(),
                ])->toArray(),
            ];

            try {
                $service = app(BedrockService::class);
                $retroContent = $service->generateWeeklyRetro($projectData);

                // Email to project owner / team lead
                $recipients = collect([$project->user?->email])->filter()->unique();

                foreach ($recipients as $email) {
                    Mail::to($email)->send(new WeeklyRetroMail($project, $retroContent, $projectData));
                }

                $this->info("Retro generated for: {$project->title}");
            } catch (\Exception $e) {
                $this->error("Failed to generate retro for {$project->title}: {$e->getMessage()}");
            }
        }

        $this->info('Weekly retros complete.');
    }
}
