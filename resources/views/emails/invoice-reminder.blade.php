<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #ef4444; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #dc2626; margin: 0; font-size: 22px; }
        .details { background: #fef2f2; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #ef4444; }
        .details p { margin: 5px 0; }
        .amount { font-size: 24px; font-weight: bold; color: #dc2626; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Payment Reminder</h1>
    </div>

    <p>Dear {{ $invoice->client->name }},</p>

    <p>This is a friendly reminder that the following invoice is due for payment:</p>

    <div class="details">
        <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
        <p><strong>Issue Date:</strong> {{ $invoice->issue_date->format('M d, Y') }}</p>
        <p><strong>Due Date:</strong> {{ $invoice->due_date->format('M d, Y') }}</p>
        @if($invoice->due_date->isPast())
            <p style="color: #dc2626;"><strong>This invoice is {{ $invoice->due_date->diffForHumans() }} overdue.</strong></p>
        @endif
        <p class="amount">Amount Due: ${{ number_format($invoice->total, 2) }}</p>
    </div>

    <p>Please process this payment at your earliest convenience. If you have already made the payment, please disregard this reminder.</p>

    <p>If you have any questions, feel free to reach out.</p>

    <div class="footer">
        <p>Olotin Temitope — Software Consulting</p>
    </div>
</body>
</html>
