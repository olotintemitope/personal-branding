<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'milestone_title',
        'description',
        'estimated_hours',
        'hourly_rate',
        'amount',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'estimated_hours' => 'decimal:2',
            'hourly_rate' => 'decimal:2',
            'amount' => 'decimal:2',
        ];
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    protected static function booted(): void
    {
        static::saving(function (OfferItem $item) {
            $item->amount = round($item->estimated_hours * $item->hourly_rate, 2);
        });

        static::saved(function (OfferItem $item) {
            $item->offer->calculateTotals();
        });

        static::deleted(function (OfferItem $item) {
            $item->offer->calculateTotals();
        });
    }
}
