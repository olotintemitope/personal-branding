<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Plus Jakarta Sans', Arial, sans-serif; line-height: 1.6; color: #333; max-width: 700px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #3b82f6; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #1e40af; margin: 0; font-size: 22px; }
        .header .date { color: #6b7280; font-size: 13px; margin-top: 4px; }
        .stats { display: flex; gap: 12px; margin: 20px 0; }
        .stat-box { background: #f9fafb; border-radius: 8px; padding: 12px; flex: 1; text-align: center; }
        .stat-box .value { font-size: 24px; font-weight: bold; color: #1e40af; }
        .stat-box .label { font-size: 11px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; }
        .retro-content { background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 3px solid #3b82f6; margin: 20px 0; }
        .retro-content h2 { color: #1e40af; font-size: 16px; margin-top: 15px; }
        .retro-content h2:first-child { margin-top: 0; }
        .retro-content ul { padding-left: 20px; }
        .retro-content li { margin: 5px 0; }
        .team-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .team-table th { background: #1e40af; color: white; padding: 8px 10px; text-align: left; font-size: 11px; text-transform: uppercase; }
        .team-table td { padding: 6px 10px; border-bottom: 1px solid #e5e7eb; font-size: 13px; }
        .team-table tr:nth-child(even) { background: #f9fafb; }
        .warning { background: #fef3c7; padding: 10px 12px; border-radius: 6px; border-left: 3px solid #f59e0b; margin: 10px 0; font-size: 13px; }
        .danger { background: #fee2e2; padding: 10px 12px; border-radius: 6px; border-left: 3px solid #dc2626; margin: 10px 0; font-size: 13px; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Weekly Retrospective</h1>
        <div class="date">{{ $project->title }} — Week of {{ now()->startOfWeek()->format('M d') }} to {{ now()->endOfWeek()->format('M d, Y') }}</div>
    </div>

    {{-- Stats Overview --}}
    <table width="100%" cellpadding="0" cellspacing="8">
        <tr>
            <td style="background: #f9fafb; border-radius: 8px; padding: 12px; text-align: center;">
                <div style="font-size: 24px; font-weight: bold; color: #1e40af;">{{ $data['overall_progress'] }}</div>
                <div style="font-size: 11px; color: #6b7280; text-transform: uppercase;">Milestone Progress</div>
            </td>
            <td style="background: #f9fafb; border-radius: 8px; padding: 12px; text-align: center;">
                <div style="font-size: 24px; font-weight: bold; color: #1e40af;">{{ $data['task_progress'] }}</div>
                <div style="font-size: 11px; color: #6b7280; text-transform: uppercase;">Task Completion</div>
            </td>
            <td style="background: #f9fafb; border-radius: 8px; padding: 12px; text-align: center;">
                <div style="font-size: 24px; font-weight: bold; color: {{ $data['total_actual_hours'] > $data['total_estimated_hours'] ? '#dc2626' : '#1e40af' }};">
                    {{ number_format($data['total_actual_hours'], 1) }}h
                </div>
                <div style="font-size: 11px; color: #6b7280; text-transform: uppercase;">of {{ number_format($data['total_estimated_hours'], 1) }}h estimated</div>
            </td>
        </tr>
    </table>

    {{-- AI Retro Content --}}
    <div class="retro-content">
        {!! Str::markdown($retroContent) !!}
    </div>

    {{-- Team Performance Table --}}
    @if(!empty($data['team_members']))
        <h3 style="color: #1e40af; font-size: 14px; margin-top: 20px;">Team Performance</h3>
        <table class="team-table">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Role</th>
                    <th>Completed</th>
                    <th>Active</th>
                    <th>Overdue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['team_members'] as $member)
                    <tr>
                        <td>{{ $member['name'] }}</td>
                        <td>{{ $member['role'] ?? '—' }}</td>
                        <td style="color: #16a34a; font-weight: bold;">{{ $member['tasks_completed'] }}</td>
                        <td>{{ $member['tasks_active'] }}</td>
                        <td style="color: {{ $member['tasks_overdue'] > 0 ? '#dc2626' : 'inherit' }}; font-weight: {{ $member['tasks_overdue'] > 0 ? 'bold' : 'normal' }};">
                            {{ $member['tasks_overdue'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Overdue Tasks Warning --}}
    @if(!empty($data['overdue_tasks']))
        <div class="danger">
            <strong>Overdue Tasks ({{ count($data['overdue_tasks']) }}):</strong>
            <ul style="margin: 5px 0 0; padding-left: 20px;">
                @foreach($data['overdue_tasks'] as $task)
                    <li>{{ $task['title'] }} — {{ $task['assignee'] ?? 'Unassigned' }} ({{ $task['days_overdue'] }} days overdue)</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Overtime Tasks Warning --}}
    @if(!empty($data['overtime_tasks']))
        <div class="warning">
            <strong>Over Time Budget ({{ count($data['overtime_tasks']) }}):</strong>
            <ul style="margin: 5px 0 0; padding-left: 20px;">
                @foreach($data['overtime_tasks'] as $task)
                    <li>{{ $task['title'] }} — {{ $task['assignee'] ?? 'Unassigned' }} ({{ $task['actual'] }}h / {{ $task['estimated'] }}h est.)</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="footer">
        <p>This retro was auto-generated by AI based on project activity data.</p>
        <p>Olotin Temitope — Software Consulting</p>
    </div>
</body>
</html>
