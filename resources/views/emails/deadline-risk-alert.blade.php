<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Plus Jakarta Sans', Arial, sans-serif; line-height: 1.6; color: #333; max-width: 700px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #dc2626; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #dc2626; margin: 0; font-size: 22px; }
        .header .project { color: #6b7280; font-size: 14px; margin-top: 4px; }
        .deadline-box { background: {{ $data['days_remaining'] < 7 ? '#fee2e2' : ($data['days_remaining'] < 14 ? '#fef3c7' : '#f0fdf4') }};
            padding: 15px; border-radius: 8px; text-align: center; margin: 20px 0;
            border: 2px solid {{ $data['days_remaining'] < 7 ? '#dc2626' : ($data['days_remaining'] < 14 ? '#f59e0b' : '#10b981') }}; }
        .deadline-box .days { font-size: 36px; font-weight: bold; color: {{ $data['days_remaining'] < 7 ? '#dc2626' : ($data['days_remaining'] < 14 ? '#d97706' : '#059669') }}; }
        .deadline-box .label { font-size: 13px; color: #6b7280; }
        .stats-row { display: table; width: 100%; margin: 15px 0; }
        .stat { display: table-cell; text-align: center; padding: 10px; background: #f9fafb; }
        .stat .value { font-size: 20px; font-weight: bold; color: #1e40af; }
        .stat .label { font-size: 11px; color: #6b7280; text-transform: uppercase; }
        .analysis { background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 3px solid #dc2626; margin: 20px 0; }
        .analysis h2 { color: #1e40af; font-size: 16px; margin-top: 15px; }
        .analysis h2:first-child { margin-top: 0; }
        .analysis ul { padding-left: 20px; }
        .team-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .team-table th { background: #1e40af; color: white; padding: 8px 10px; text-align: left; font-size: 11px; text-transform: uppercase; }
        .team-table td { padding: 6px 10px; border-bottom: 1px solid #e5e7eb; font-size: 12px; }
        .team-table tr:nth-child(even) { background: #f9fafb; }
        .flag { display: inline-block; padding: 1px 6px; border-radius: 8px; font-size: 10px; font-weight: bold; }
        .flag-danger { background: #fee2e2; color: #dc2626; }
        .flag-warning { background: #fef3c7; color: #d97706; }
        .flag-success { background: #dcfce7; color: #16a34a; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Deadline Risk Alert</h1>
        <div class="project">{{ $project->title }} — Deadline: {{ $project->end_date->format('M d, Y') }}</div>
    </div>

    <div class="deadline-box">
        <div class="days">{{ $data['days_remaining'] }}</div>
        <div class="label">days remaining until deadline</div>
    </div>

    {{-- Quick Stats --}}
    <table width="100%" cellpadding="0" cellspacing="6">
        <tr>
            <td style="background: #f9fafb; border-radius: 6px; padding: 10px; text-align: center;">
                <div style="font-size: 20px; font-weight: bold; color: #1e40af;">{{ $data['completion_rate'] }}</div>
                <div style="font-size: 10px; color: #6b7280; text-transform: uppercase;">Tasks Done</div>
            </td>
            <td style="background: #f9fafb; border-radius: 6px; padding: 10px; text-align: center;">
                <div style="font-size: 20px; font-weight: bold; color: {{ $data['overdue_tasks_count'] > 0 ? '#dc2626' : '#1e40af' }};">{{ $data['overdue_tasks_count'] }}</div>
                <div style="font-size: 10px; color: #6b7280; text-transform: uppercase;">Overdue</div>
            </td>
            <td style="background: #f9fafb; border-radius: 6px; padding: 10px; text-align: center;">
                <div style="font-size: 20px; font-weight: bold; color: #1e40af;">{{ number_format($data['remaining_estimated_hours'], 0) }}h</div>
                <div style="font-size: 10px; color: #6b7280; text-transform: uppercase;">Remaining Work</div>
            </td>
        </tr>
    </table>

    {{-- AI Analysis --}}
    <div class="analysis">
        {!! Str::markdown($analysis) !!}
    </div>

    {{-- Team Velocity --}}
    @if(!empty($data['team_velocity']))
        <h3 style="color: #1e40af; font-size: 14px; margin-top: 20px;">Team Velocity & Performance</h3>
        <table class="team-table">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Role</th>
                    <th>Done</th>
                    <th>Active</th>
                    <th>Overdue</th>
                    <th>Acceptance</th>
                    <th>Avg Speed</th>
                    <th>Accuracy</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['team_velocity'] as $member)
                    <tr>
                        <td>
                            {{ $member['name'] }}
                            @if($member['overdue'] > 2)
                                <span class="flag flag-danger">AT RISK</span>
                            @elseif($member['overdue'] > 0)
                                <span class="flag flag-warning">WATCH</span>
                            @endif
                        </td>
                        <td>{{ $member['role'] ?? '—' }}</td>
                        <td style="color: #16a34a; font-weight: bold;">{{ $member['completed'] }}</td>
                        <td>{{ $member['total_assigned'] - $member['completed'] }}</td>
                        <td style="color: {{ $member['overdue'] > 0 ? '#dc2626' : 'inherit' }}; font-weight: {{ $member['overdue'] > 0 ? 'bold' : 'normal' }};">{{ $member['overdue'] }}</td>
                        <td>{{ $member['acceptance_rate'] }}</td>
                        <td>{{ $member['avg_completion_hours'] }}{{ $member['avg_completion_hours'] !== 'N/A' ? 'h' : '' }}</td>
                        <td>{{ $member['estimate_accuracy'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        <p>This alert was auto-generated by AI analysis of project progress data.</p>
        <p>Olotin Temitope — Software Consulting</p>
    </div>
</body>
</html>
