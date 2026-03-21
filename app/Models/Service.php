<?php

namespace App\Models;

use App\Enums\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'prices',
        'price_unit',
        'badge',
        'features',
        'cta_label',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'prices' => 'array',
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function priceFor(Currency $currency): ?string
    {
        $prices = $this->prices ?? [];

        return $prices[$currency->value] ?? $prices['USD'] ?? null;
    }

    public function formattedPriceFor(Currency $currency): string
    {
        $amount = $this->priceFor($currency);

        if ($amount === null) {
            return 'Contact';
        }

        return $currency->symbol() . number_format((float) $amount);
    }
}
