<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #3b82f6; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #1e40af; margin: 0; font-size: 22px; }
        .details { background: #f9fafb; padding: 15px; border-radius: 8px; margin: 20px 0; }
        .details p { margin: 5px 0; }
        .amount { font-size: 24px; font-weight: bold; color: #1e40af; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $offer->title }}</h1>
    </div>

    <p>Dear {{ $offer->client->name }},</p>

    <p>Please find attached our offer for your review.</p>

    <div class="details">
        <p><strong>Offer Number:</strong> {{ $offer->offer_number }}</p>
        <p><strong>Project:</strong> {{ $offer->project->title }}</p>
        @if($offer->valid_until)
            <p><strong>Valid Until:</strong> {{ $offer->valid_until->format('M d, Y') }}</p>
        @endif
        <p class="amount">Total: ${{ number_format($offer->total, 2) }}</p>
    </div>

    <p>This offer includes a detailed breakdown of milestones, estimated hours, and pricing. Please review the attached PDF for full details.</p>

    <p>We look forward to working with you. Please don't hesitate to reach out if you have any questions.</p>

    <div class="footer">
        <p>Olotin Temitope — Software Consulting</p>
    </div>
</body>
</html>
