<?php

namespace App\Console\Commands;

use App\Enums\ProjectStatus;
use App\Mail\WeeklyProjectDigestMail;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWeeklyProjectDigest extends Command
{
    protected $signature = 'app:send-weekly-project-digest';

    protected $description = 'Send weekly project digest emails to clients with active projects';

    public function handle(): void
    {
        $weekAgo = now()->subWeek();

        $projects = Project::where('status', ProjectStatus::InProgress)
            ->whereHas('client', fn ($q) => $q->whereNotNull('email'))
            ->with('client')
            ->get();

        foreach ($projects as $project) {
            $completedMilestones = $project->milestones()
                ->where('completed_at', '>=', $weekAgo)
                ->get();

            $meetings = $project->meetings()
                ->where('scheduled_at', '>=', $weekAgo)
                ->get();

            $updates = $project->updates()
                ->where('created_at', '>=', $weekAgo)
                ->get();

            // Only send if there's something to report
            if ($completedMilestones->isEmpty() && $meetings->isEmpty() && $updates->isEmpty()) {
                continue;
            }

            $digest = [
                'completed_milestones' => $completedMilestones,
                'meetings' => $meetings,
                'updates' => $updates,
            ];

            Mail::to($project->client->email)
                ->send(new WeeklyProjectDigestMail($project, $digest));

            $this->info("Sent digest for: {$project->title}");
        }

        $this->info('Weekly project digest complete.');
    }
}
