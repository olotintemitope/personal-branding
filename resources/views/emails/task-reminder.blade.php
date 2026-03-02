<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #f59e0b; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #d97706; margin: 0; font-size: 22px; }
        .details { background: #fffbeb; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 3px solid #f59e0b; }
        .details p { margin: 5px 0; }
        .time-info { background: #f9fafb; padding: 12px; border-radius: 6px; margin: 15px 0; }
        .overdue { color: #dc2626; font-weight: bold; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Task Reminder</h1>
    </div>

    <p>Hi {{ $task->assignee->name }},</p>

    <p>This is a reminder about a task that needs your attention:</p>

    <div class="details">
        <p><strong>Task:</strong> {{ $task->title }}</p>
        <p><strong>Project:</strong> {{ $task->project->title }}</p>
        @if($task->milestone)
            <p><strong>Milestone:</strong> {{ $task->milestone->title }}</p>
        @endif
        <p><strong>Status:</strong> {{ $task->status->getLabel() }}</p>
        <p><strong>Priority:</strong> {{ $task->priority->getLabel() }}</p>
        @if($task->due_date)
            <p class="{{ $task->due_date->isPast() ? 'overdue' : '' }}">
                <strong>Due Date:</strong> {{ $task->due_date->format('M d, Y') }}
                @if($task->due_date->isPast())
                    (OVERDUE by {{ $task->due_date->diffForHumans() }})
                @else
                    ({{ $task->due_date->diffForHumans() }})
                @endif
            </p>
        @endif
    </div>

    <div class="time-info">
        @if($task->estimated_hours)
            <p><strong>Estimated:</strong> {{ number_format($task->estimated_hours, 1) }} hours</p>
        @endif
        <p><strong>Time Logged:</strong> {{ number_format($task->actual_hours, 1) }} hours</p>
        @if($task->estimated_hours && $task->isOvertime())
            <p class="overdue">This task has exceeded its time estimate by {{ number_format($task->actual_hours - $task->estimated_hours, 1) }} hours.</p>
        @endif
    </div>

    <p>Please update the status or log your progress when you have a chance.</p>

    <div class="footer">
        <p>Olotin Temitope — Software Consulting</p>
    </div>
</body>
</html>
