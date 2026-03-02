<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 13px; color: #333; line-height: 1.5; }
        .proposal { padding: 40px; }
        .header { display: table; width: 100%; margin-bottom: 40px; }
        .header-left { display: table-cell; width: 50%; vertical-align: top; }
        .header-right { display: table-cell; width: 50%; vertical-align: top; text-align: right; }
        .company-name { font-size: 24px; font-weight: bold; color: #1e40af; margin-bottom: 5px; }
        .company-detail { color: #6b7280; font-size: 12px; }
        .proposal-title { font-size: 28px; font-weight: bold; color: #1e40af; }
        .proposal-label { font-size: 14px; color: #6b7280; margin-top: 5px; }
        .meta { display: table; width: 100%; margin-bottom: 30px; }
        .meta-left { display: table-cell; width: 50%; vertical-align: top; }
        .meta-right { display: table-cell; width: 50%; vertical-align: top; text-align: right; }
        .section-title { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #6b7280; margin-bottom: 5px; font-weight: bold; }
        .client-name { font-size: 16px; font-weight: bold; margin-bottom: 3px; }
        .meta-value { margin-bottom: 3px; }
        .content-section { margin: 25px 0; padding: 20px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #1e40af; }
        .content-title { font-weight: bold; margin-bottom: 10px; color: #1e40af; font-size: 14px; }
        .amount-section { width: 300px; margin-left: auto; margin-top: 30px; }
        .amount-section table { width: 100%; }
        .amount-section td { padding: 6px 0; }
        .amount-section td:last-child { text-align: right; font-weight: bold; }
        .amount-section .total-row { border-top: 2px solid #1e40af; font-size: 18px; color: #1e40af; }
        .amount-section .total-row td { padding-top: 10px; }
        .validity { margin-top: 30px; padding: 12px 15px; background: #eff6ff; border-radius: 6px; text-align: center; color: #1e40af; font-weight: bold; }
        .footer { margin-top: 50px; text-align: center; color: #9ca3af; font-size: 11px; border-top: 1px solid #e5e7eb; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="proposal">
        <div class="header">
            <div class="header-left">
                <div class="company-name">Olotin Temitope</div>
                <div class="company-detail">Software Consulting</div>
                <div class="company-detail">hello@olotintemitope.com</div>
            </div>
            <div class="header-right">
                <div class="proposal-title">PROPOSAL</div>
                <div class="proposal-label">{{ $proposal->created_at->format('M d, Y') }}</div>
            </div>
        </div>

        <div class="meta">
            <div class="meta-left">
                <div class="section-title">Prepared For</div>
                <div class="client-name">{{ $proposal->project->client->name }}</div>
                @if($proposal->project->client->company)
                    <div class="meta-value">{{ $proposal->project->client->company }}</div>
                @endif
                @if($proposal->project->client->email)
                    <div class="meta-value">{{ $proposal->project->client->email }}</div>
                @endif
                @if($proposal->project->client->phone)
                    <div class="meta-value">{{ $proposal->project->client->phone }}</div>
                @endif
            </div>
            <div class="meta-right">
                <div class="section-title">Proposal Details</div>
                <div class="meta-value"><strong>Project:</strong> {{ $proposal->project->title }}</div>
                <div class="meta-value"><strong>Status:</strong> {{ $proposal->status->getLabel() }}</div>
                @if($proposal->valid_until)
                    <div class="meta-value"><strong>Valid Until:</strong> {{ $proposal->valid_until->format('M d, Y') }}</div>
                @endif
            </div>
        </div>

        <h2 style="color: #1e40af; font-size: 18px; margin-bottom: 15px;">{{ $proposal->title }}</h2>

        @if($proposal->content)
            <div class="content-section">
                <div class="content-title">Proposal Details</div>
                {!! $proposal->content !!}
            </div>
        @endif

        @if($proposal->amount)
            <div class="amount-section">
                <table>
                    <tr class="total-row">
                        <td>Total Amount</td>
                        <td>{{ ($proposal->project->currency ?? \App\Enums\Currency::USD)->format($proposal->amount) }}</td>
                    </tr>
                </table>
            </div>
        @endif

        @if($proposal->valid_until)
            <div class="validity">
                This proposal is valid until {{ $proposal->valid_until->format('F d, Y') }}
            </div>
        @endif

        <div class="footer">
            <p>Thank you for considering our services!</p>
            <p>Olotin Temitope — Software Consulting</p>
        </div>
    </div>
</body>
</html>
