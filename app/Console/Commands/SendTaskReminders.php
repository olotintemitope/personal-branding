<?php

namespace App\Console\Commands;

use App\Enums\TaskStatus;
use App\Mail\TaskReminderMail;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTaskReminders extends Command
{
    protected $signature = 'app:send-task-reminders';

    protected $description = 'Send reminders for tasks that are overdue or stale (not completed and no recent updates)';

    public function handle(): void
    {
        $staleTasks = Task::whereNotIn('status', [
            TaskStatus::Completed->value,
            TaskStatus::Todo->value,
        ])
            ->whereNotNull('assigned_to')
            ->where(function ($query) {
                // Overdue tasks
                $query->where('due_date', '<', now())
                    // Or tasks with no updates in the last 3 days
                    ->orWhere(function ($q) {
                        $q->whereDoesntHave('updates', function ($uq) {
                            $uq->where('created_at', '>=', now()->subDays(3));
                        })
                            ->where('started_at', '<', now()->subDays(3));
                    });
            })
            ->with(['assignee', 'project'])
            ->get();

        foreach ($staleTasks as $task) {
            if ($task->assignee?->email) {
                Mail::to($task->assignee->email)
                    ->send(new TaskReminderMail($task));

                $this->info("Reminder sent for: {$task->title} → {$task->assignee->name}");
            }
        }

        $this->info("Sent {$staleTasks->count()} task reminders.");
    }
}
