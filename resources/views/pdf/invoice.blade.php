<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 13px; color: #333; line-height: 1.5; }
        .invoice { padding: 40px; }
        .header { display: table; width: 100%; margin-bottom: 40px; }
        .header-left { display: table-cell; width: 50%; vertical-align: top; }
        .header-right { display: table-cell; width: 50%; vertical-align: top; text-align: right; }
        .company-name { font-size: 24px; font-weight: bold; color: #1e40af; margin-bottom: 5px; }
        .company-detail { color: #6b7280; font-size: 12px; }
        .invoice-title { font-size: 28px; font-weight: bold; color: #1e40af; }
        .invoice-number { font-size: 14px; color: #6b7280; margin-top: 5px; }
        .meta { display: table; width: 100%; margin-bottom: 30px; }
        .meta-left { display: table-cell; width: 50%; vertical-align: top; }
        .meta-right { display: table-cell; width: 50%; vertical-align: top; text-align: right; }
        .section-title { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #6b7280; margin-bottom: 5px; font-weight: bold; }
        .client-name { font-size: 16px; font-weight: bold; margin-bottom: 3px; }
        .meta-value { margin-bottom: 3px; }
        .status-badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .status-draft { background: #f3f4f6; color: #6b7280; }
        .status-sent { background: #dbeafe; color: #1d4ed8; }
        .status-paid { background: #dcfce7; color: #16a34a; }
        .status-overdue { background: #fee2e2; color: #dc2626; }
        table.items { width: 100%; border-collapse: collapse; margin: 30px 0; }
        table.items thead th { background: #1e40af; color: white; padding: 10px 12px; text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
        table.items thead th:last-child,
        table.items thead th:nth-child(3),
        table.items thead th:nth-child(4) { text-align: right; }
        table.items tbody td { padding: 10px 12px; border-bottom: 1px solid #e5e7eb; }
        table.items tbody td:last-child,
        table.items tbody td:nth-child(3),
        table.items tbody td:nth-child(4) { text-align: right; }
        table.items tbody tr:nth-child(even) { background: #f9fafb; }
        .totals { width: 300px; margin-left: auto; margin-top: 20px; }
        .totals table { width: 100%; }
        .totals td { padding: 6px 0; }
        .totals td:last-child { text-align: right; font-weight: bold; }
        .totals .total-row { border-top: 2px solid #1e40af; font-size: 18px; color: #1e40af; }
        .totals .total-row td { padding-top: 10px; }
        .notes { margin-top: 40px; padding: 15px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #1e40af; }
        .notes-title { font-weight: bold; margin-bottom: 5px; color: #1e40af; }
        .footer { margin-top: 50px; text-align: center; color: #9ca3af; font-size: 11px; border-top: 1px solid #e5e7eb; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <div class="header-left">
                <div class="company-name">Olotin Temitope</div>
                <div class="company-detail">Software Consulting</div>
                <div class="company-detail">hello@olotintemitope.com</div>
            </div>
            <div class="header-right">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">{{ $invoice->invoice_number }}</div>
            </div>
        </div>

        <div class="meta">
            <div class="meta-left">
                <div class="section-title">Bill To</div>
                <div class="client-name">{{ $invoice->client->name }}</div>
                @if($invoice->client->company)
                    <div class="meta-value">{{ $invoice->client->company }}</div>
                @endif
                @if($invoice->client->email)
                    <div class="meta-value">{{ $invoice->client->email }}</div>
                @endif
                @if($invoice->client->phone)
                    <div class="meta-value">{{ $invoice->client->phone }}</div>
                @endif
            </div>
            <div class="meta-right">
                <div class="section-title">Invoice Details</div>
                <div class="meta-value"><strong>Issue Date:</strong> {{ $invoice->issue_date->format('M d, Y') }}</div>
                <div class="meta-value"><strong>Due Date:</strong> {{ $invoice->due_date->format('M d, Y') }}</div>
                <div class="meta-value">
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $invoice->status->value }}">{{ $invoice->status->getLabel() }}</span>
                </div>
                <div class="meta-value"><strong>Currency:</strong> {{ ($invoice->currency ?? \App\Enums\Currency::USD)->value }}</div>
                @if($invoice->project)
                    <div class="meta-value"><strong>Project:</strong> {{ $invoice->project->title }}</div>
                @endif
                @if($invoice->vat_number || $invoice->client?->vat_number)
                    <div class="meta-value"><strong>VAT #:</strong> {{ $invoice->vat_number ?? $invoice->client->vat_number }}</div>
                @endif
            </div>
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th style="width: 50%">Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                    <tr>
                        <td>{{ $item->description }}</td>
                        <td style="text-align: right;">{{ number_format($item->quantity, 2) }}</td>
                        <td style="text-align: right;">{{ ($invoice->currency ?? \App\Enums\Currency::USD)->format($item->unit_price) }}</td>
                        <td style="text-align: right;">{{ ($invoice->currency ?? \App\Enums\Currency::USD)->format($item->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>{{ ($invoice->currency ?? \App\Enums\Currency::USD)->format($invoice->subtotal) }}</td>
                </tr>
                @if($invoice->tax_rate > 0)
                    <tr>
                        <td>VAT / Tax ({{ number_format($invoice->tax_rate, 2) }}%)</td>
                        <td>{{ ($invoice->currency ?? \App\Enums\Currency::USD)->format($invoice->tax_amount) }}</td>
                    </tr>
                @endif
                <tr class="total-row">
                    <td>Total</td>
                    <td>{{ ($invoice->currency ?? \App\Enums\Currency::USD)->format($invoice->total) }}</td>
                </tr>
            </table>
        </div>

        @if($invoice->notes)
            <div class="notes">
                <div class="notes-title">Notes</div>
                <p>{{ $invoice->notes }}</p>
            </div>
        @endif

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>Olotin Temitope — Software Consulting</p>
        </div>
    </div>
</body>
</html>
