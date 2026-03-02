<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #10b981; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #059669; margin: 0; font-size: 22px; }
        .details { background: #f0fdf4; padding: 15px; border-radius: 8px; margin: 20px 0; }
        .details p { margin: 5px 0; }
        .progress { font-size: 20px; font-weight: bold; color: #059669; }
        .progress-bar { background: #e5e7eb; border-radius: 10px; height: 20px; margin: 10px 0; overflow: hidden; }
        .progress-fill { background: #10b981; height: 100%; border-radius: 10px; }
        .remaining { margin: 20px 0; }
        .remaining ul { padding-left: 20px; }
        .remaining li { margin: 5px 0; color: #6b7280; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Milestone Completed!</h1>
    </div>

    <p>Dear {{ $project->client->name }},</p>

    <p>We're pleased to inform you that a milestone has been completed on your project.</p>

    <div class="details">
        <p><strong>Project:</strong> {{ $project->title }}</p>
        <p><strong>Milestone:</strong> {{ $milestone->title }}</p>
        <p><strong>Completed:</strong> {{ $milestone->completed_at->format('M d, Y') }}</p>
        <p class="progress">Project Progress: {{ $completionPercentage }}%</p>
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $completionPercentage }}%"></div>
        </div>
    </div>

    @if($remainingMilestones->isNotEmpty())
        <div class="remaining">
            <p><strong>Remaining Milestones:</strong></p>
            <ul>
                @foreach($remainingMilestones as $remaining)
                    <li>{{ $remaining->title }}@if($remaining->due_date) — Due {{ $remaining->due_date->format('M d, Y') }}@endif</li>
                @endforeach
            </ul>
        </div>
    @else
        <p><strong>All milestones have been completed! Your project is fully delivered.</strong></p>
    @endif

    <div class="footer">
        <p>Olotin Temitope — Software Consulting</p>
    </div>
</body>
</html>
