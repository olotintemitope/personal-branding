<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #10b981; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #059669; margin: 0; font-size: 22px; }
        .summary { background: #f0fdf4; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .summary p { margin: 5px 0; }
        .highlight { font-size: 20px; font-weight: bold; color: #059669; text-align: center; margin: 15px 0; }
        .milestones { margin: 20px 0; }
        .milestones ul { padding-left: 20px; }
        .milestones li { margin: 5px 0; }
        .warning { background: #fef3c7; padding: 12px; border-radius: 6px; border-left: 3px solid #f59e0b; margin: 20px 0; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Project Completed!</h1>
    </div>

    <p>Dear {{ $project->client->name }},</p>

    <p>We are delighted to inform you that your project has been successfully completed.</p>

    <div class="summary">
        <p><strong>Project:</strong> {{ $project->title }}</p>
        @if($project->start_date)
            <p><strong>Started:</strong> {{ $project->start_date->format('M d, Y') }}</p>
        @endif
        <p><strong>Completed:</strong> {{ $project->completed_at->format('M d, Y') }}</p>
        <p><strong>Total Milestones Delivered:</strong> {{ $totalMilestones }}</p>
    </div>

    <div class="highlight">
        Thank you for trusting us with your project!
    </div>

    @if($project->milestones->isNotEmpty())
        <div class="milestones">
            <p><strong>Delivered Milestones:</strong></p>
            <ul>
                @foreach($project->milestones as $milestone)
                    <li>{{ $milestone->title }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($unpaidInvoices->isNotEmpty())
        <div class="warning">
            <strong>Note:</strong> There {{ $unpaidInvoices->count() === 1 ? 'is' : 'are' }} {{ $unpaidInvoices->count() }} outstanding {{ Str::plural('invoice', $unpaidInvoices->count()) }} totaling ${{ number_format($unpaidInvoices->sum('total'), 2) }}. Please ensure payment is processed at your earliest convenience.
        </div>
    @endif

    <p>It has been a pleasure working with you. We hope to collaborate again in the future!</p>

    <div class="footer">
        <p>Olotin Temitope — Software Consulting</p>
    </div>
</body>
</html>
