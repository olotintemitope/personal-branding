<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\InvoiceStatus;
use App\Enums\OfferStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_number',
        'project_id',
        'client_id',
        'user_id',
        'title',
        'cover_letter',
        'status',
        'tax_rate',
        'subtotal',
        'tax_amount',
        'total',
        'valid_until',
        'sent_at',
        'accepted_at',
        'invoice_id',
        'currency',
    ];

    protected function casts(): array
    {
        return [
            'status' => OfferStatus::class,
            'currency' => Currency::class,
            'tax_rate' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'total' => 'decimal:2',
            'valid_until' => 'date',
            'sent_at' => 'datetime',
            'accepted_at' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OfferItem::class)->orderBy('sort_order');
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function calculateTotals(): void
    {
        $this->subtotal = $this->items()->sum('amount');
        $this->tax_amount = round($this->subtotal * ($this->tax_rate / 100), 2);
        $this->total = $this->subtotal + $this->tax_amount;
        $this->saveQuietly();
    }

    public static function generateOfferNumber(): string
    {
        $prefix = 'OFF-' . now()->format('Ym') . '-';
        $lastOffer = static::where('offer_number', 'like', $prefix . '%')
            ->orderByDesc('offer_number')
            ->first();

        if ($lastOffer) {
            $lastNumber = (int) substr($lastOffer->offer_number, -3);
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '001';
        }

        return $prefix . $nextNumber;
    }

    public function convertToInvoice(): Invoice
    {
        $invoice = Invoice::create([
            'invoice_number' => Invoice::generateInvoiceNumber(),
            'client_id' => $this->client_id,
            'project_id' => $this->project_id,
            'user_id' => $this->user_id,
            'status' => InvoiceStatus::Draft,
            'issue_date' => now(),
            'due_date' => now()->addDays(30),
            'tax_rate' => $this->tax_rate,
            'currency' => $this->currency ?? Currency::USD,
            'notes' => "Converted from offer {$this->offer_number}",
        ]);

        foreach ($this->items as $item) {
            $invoice->items()->create([
                'description' => "{$item->milestone_title}" . ($item->description ? " — {$item->description}" : ''),
                'quantity' => $item->estimated_hours,
                'unit_price' => $item->hourly_rate,
            ]);
        }

        $invoice->calculateTotals();

        $this->update([
            'status' => OfferStatus::Converted,
            'invoice_id' => $invoice->id,
        ]);

        return $invoice;
    }
}
