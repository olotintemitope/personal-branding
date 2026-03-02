<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #3b82f6; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #1e40af; margin: 0; font-size: 22px; }
        .progress { font-size: 18px; font-weight: bold; color: #1e40af; margin: 10px 0; }
        .progress-bar { background: #e5e7eb; border-radius: 10px; height: 16px; margin: 10px 0; overflow: hidden; }
        .progress-fill { background: #3b82f6; height: 100%; border-radius: 10px; }
        .section { margin: 25px 0; }
        .section h2 { color: #1e40af; font-size: 16px; margin-bottom: 10px; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px; }
        .section ul { padding-left: 20px; }
        .section li { margin: 8px 0; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 11px; font-weight: bold; }
        .badge-success { background: #dcfce7; color: #16a34a; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Weekly Project Update</h1>
    </div>

    <p>Dear {{ $project->client->name }},</p>

    <p>Here's your weekly update for <strong>{{ $project->title }}</strong>.</p>

    <div class="progress">Overall Progress: {{ $completionPercentage }}%</div>
    <div class="progress-bar">
        <div class="progress-fill" style="width: {{ $completionPercentage }}%"></div>
    </div>

    @if($completedMilestones->isNotEmpty())
        <div class="section">
            <h2>Milestones Completed This Week</h2>
            <ul>
                @foreach($completedMilestones as $milestone)
                    <li>
                        <span class="badge badge-success">Completed</span>
                        {{ $milestone->title }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($meetings->isNotEmpty())
        <div class="section">
            <h2>Meetings This Week</h2>
            <ul>
                @foreach($meetings as $meeting)
                    <li>{{ $meeting->title }} — {{ $meeting->scheduled_at->format('M d, Y g:i A') }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($updates->isNotEmpty())
        <div class="section">
            <h2>Project Updates</h2>
            <ul>
                @foreach($updates as $update)
                    <li>
                        <strong>{{ $update->title }}</strong><br>
                        {{ Str::limit(strip_tags($update->content), 150) }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>If you have any questions or concerns, please don't hesitate to reach out.</p>

    <div class="footer">
        <p>Olotin Temitope — Software Consulting</p>
    </div>
</body>
</html>
