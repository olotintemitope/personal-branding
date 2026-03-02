<?php

namespace App\Livewire;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use Filament\Notifications\Notification;
use Livewire\Component;

class ProjectTaskBoard extends Component
{
    public Project $project;

    public bool $showCreateForm = false;

    public string $newTaskTitle = '';

    public string $newTaskStatus = 'todo';

    public string $newTaskPriority = 'medium';

    public function mount(Project $project): void
    {
        $this->project = $project;
    }

    public function getTasksByStatusProperty(): array
    {
        $tasks = $this->project->tasks()
            ->with(['assignee', 'milestone'])
            ->orderBy('sort_order')
            ->orderByDesc('priority')
            ->get();

        $grouped = [];
        foreach (TaskStatus::cases() as $status) {
            $grouped[$status->value] = $tasks->where('status', $status)->values();
        }

        return $grouped;
    }

    public function moveTask(int $taskId, string $newStatus): void
    {
        $task = $this->project->tasks()->findOrFail($taskId);
        $status = TaskStatus::from($newStatus);

        $updates = ['status' => $status];

        if ($status === TaskStatus::InProgress && ! $task->started_at) {
            $updates['started_at'] = now();
        }

        if ($status === TaskStatus::Completed) {
            $updates['completed_at'] = now();
        }

        $task->update($updates);

        $task->updates()->create([
            'user_id' => auth()->id(),
            'content' => "Status changed to {$status->getLabel()}.",
            'status_change' => $status->value,
        ]);

        Notification::make()->success()->title("Task moved to {$status->getLabel()}")->send();
    }

    public function assignTask(int $taskId, ?int $userId): void
    {
        $task = $this->project->tasks()->findOrFail($taskId);
        $task->update(['assigned_to' => $userId]);

        $userName = $userId ? \App\Models\User::find($userId)?->name ?? 'Unknown' : 'nobody';
        Notification::make()->success()->title("Task assigned to {$userName}")->send();
    }

    public function createTask(): void
    {
        if (blank($this->newTaskTitle)) {
            return;
        }

        $this->project->tasks()->create([
            'title' => $this->newTaskTitle,
            'status' => TaskStatus::from($this->newTaskStatus),
            'priority' => TaskPriority::from($this->newTaskPriority),
            'created_by' => auth()->id(),
        ]);

        $this->newTaskTitle = '';
        $this->showCreateForm = false;

        Notification::make()->success()->title('Task created')->send();
    }

    public function render()
    {
        $teamMembers = $this->project->teamMembers()->get(['users.id', 'users.name']);

        return view('livewire.project-task-board', [
            'tasksByStatus' => $this->tasksByStatus,
            'columns' => [
                TaskStatus::Todo,
                TaskStatus::InProgress,
                TaskStatus::InReview,
                TaskStatus::Completed,
                TaskStatus::Blocked,
            ],
            'project' => $this->project,
            'teamMembers' => $teamMembers,
        ]);
    }
}
