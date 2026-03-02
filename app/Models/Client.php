<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'vat_number',
        'notes',
        'brand_color',
        'website',
        'brand_guidelines',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('brand_logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp']);

        $this->addMediaCollection('brand_assets')
            ->acceptsMimeTypes([
                'image/jpeg', 'image/png', 'image/svg+xml', 'image/webp',
                'application/pdf',
                'application/zip',
            ]);
    }
}
