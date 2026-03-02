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
        <h1>Invoice {{ $invoice->invoice_number }}</h1>
    </div>

    <p>Dear {{ $invoice->client->name }},</p>

    <p>Please find attached the invoice for your review.</p>

    <div class="details">
        <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
        <p><strong>Issue Date:</strong> {{ $invoice->issue_date->format('M d, Y') }}</p>
        <p><strong>Due Date:</strong> {{ $invoice->due_date->format('M d, Y') }}</p>
        <p class="amount">Total: ${{ number_format($invoice->total, 2) }}</p>
    </div>

    <p>Please process this payment by the due date. If you have any questions, don't hesitate to reach out.</p>

    <div class="footer">
        <p>Olotin Temitope — Software Consulting</p>
    </div>
</body>
</html>
