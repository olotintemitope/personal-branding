<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 13px; color: #333; line-height: 1.5; }
        .offer { padding: 40px; }
        .header { display: table; width: 100%; margin-bottom: 40px; }
        .header-left { display: table-cell; width: 50%; vertical-align: top; }
        .header-right { display: table-cell; width: 50%; vertical-align: top; text-align: right; }
        .company-name { font-size: 24px; font-weight: bold; color: #1e40af; margin-bottom: 5px; }
        .company-detail { color: #6b7280; font-size: 12px; }
        .offer-title { font-size: 28px; font-weight: bold; color: #1e40af; }
        .offer-number { font-size: 14px; color: #6b7280; margin-top: 5px; }
        .meta { display: table; width: 100%; margin-bottom: 30px; }
        .meta-left { display: table-cell; width: 50%; vertical-align: top; }
        .meta-right { display: table-cell; width: 50%; vertical-align: top; text-align: right; }
        .section-title { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #6b7280; margin-bottom: 5px; font-weight: bold; }
        .client-name { font-size: 16px; font-weight: bold; margin-bottom: 3px; }
        .meta-value { margin-bottom: 3px; }
        .cover-letter { margin: 25px 0; padding: 20px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #1e40af; }
        .cover-letter-title { font-weight: bold; margin-bottom: 10px; color: #1e40af; font-size: 14px; }
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
        .milestone-desc { color: #6b7280; font-size: 11px; margin-top: 3px; }
        .totals { width: 300px; margin-left: auto; margin-top: 20px; }
        .totals table { width: 100%; }
        .totals td { padding: 6px 0; }
        .totals td:last-child { text-align: right; font-weight: bold; }
        .totals .total-row { border-top: 2px solid #1e40af; font-size: 18px; color: #1e40af; }
        .totals .total-row td { padding-top: 10px; }
        .validity { margin-top: 30px; padding: 12px 15px; background: #eff6ff; border-radius: 6px; text-align: center; color: #1e40af; font-weight: bold; }
        .footer { margin-top: 50px; text-align: center; color: #9ca3af; font-size: 11px; border-top: 1px solid #e5e7eb; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="offer">
        <div class="header">
            <div class="header-left">
                <div class="company-name">Olotin Temitope</div>
                <div class="company-detail">Software Consulting</div>
                <div class="company-detail">hello@olotintemitope.com</div>
            </div>
            <div class="header-right">
                <div class="offer-title">OFFER</div>
                <div class="offer-number">{{ $offer->offer_number }}</div>
            </div>
        </div>

        <div class="meta">
            <div class="meta-left">
                <div class="section-title">Prepared For</div>
                <div class="client-name">{{ $offer->client->name }}</div>
                @if($offer->client->company)
                    <div class="meta-value">{{ $offer->client->company }}</div>
                @endif
                @if($offer->client->email)
                    <div class="meta-value">{{ $offer->client->email }}</div>
                @endif
                @if($offer->client->phone)
                    <div class="meta-value">{{ $offer->client->phone }}</div>
                @endif
            </div>
            <div class="meta-right">
                <div class="section-title">Offer Details</div>
                <div class="meta-value"><strong>Date:</strong> {{ $offer->created_at->format('M d, Y') }}</div>
                @if($offer->valid_until)
                    <div class="meta-value"><strong>Valid Until:</strong> {{ $offer->valid_until->format('M d, Y') }}</div>
                @endif
                @if($offer->project)
                    <div class="meta-value"><strong>Project:</strong> {{ $offer->project->title }}</div>
                @endif
            </div>
        </div>

        <h2 style="color: #1e40af; font-size: 18px; margin-bottom: 15px;">{{ $offer->title }}</h2>

        @if($offer->cover_letter)
            <div class="cover-letter">
                <div class="cover-letter-title">Cover Letter</div>
                {!! $offer->cover_letter !!}
            </div>
        @endif

        <table class="items">
            <thead>
                <tr>
                    <th style="width: 40%">Milestone</th>
                    <th>Description</th>
                    <th>Est. Hours</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offer->items as $item)
                    <tr>
                        <td>{{ $item->milestone_title }}</td>
                        <td>{{ $item->description ?? '—' }}</td>
                        <td style="text-align: right;">{{ number_format($item->estimated_hours, 1) }}</td>
                        <td style="text-align: right;">{{ ($offer->currency ?? \App\Enums\Currency::USD)->format($item->hourly_rate) }}/hr</td>
                        <td style="text-align: right;">{{ ($offer->currency ?? \App\Enums\Currency::USD)->format($item->amount) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>{{ ($offer->currency ?? \App\Enums\Currency::USD)->format($offer->subtotal) }}</td>
                </tr>
                @if($offer->tax_rate > 0)
                    <tr>
                        <td>VAT / Tax ({{ number_format($offer->tax_rate, 2) }}%)</td>
                        <td>{{ ($offer->currency ?? \App\Enums\Currency::USD)->format($offer->tax_amount) }}</td>
                    </tr>
                @endif
                <tr class="total-row">
                    <td>Total</td>
                    <td>{{ ($offer->currency ?? \App\Enums\Currency::USD)->format($offer->total) }}</td>
                </tr>
            </table>
        </div>

        @if($offer->valid_until)
            <div class="validity">
                This offer is valid until {{ $offer->valid_until->format('F d, Y') }}
            </div>
        @endif

        <div class="footer">
            <p>Thank you for considering our services!</p>
            <p>Olotin Temitope — Software Consulting</p>
        </div>
    </div>
</body>
</html>
