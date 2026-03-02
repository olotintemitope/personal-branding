<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Embedding extends Model
{
    protected $fillable = [
        'embeddable_type',
        'embeddable_id',
        'content',
        'embedding',
        'collection',
        'chunk_index',
        'content_hash',
    ];

    protected function casts(): array
    {
        return [
            'embedding' => 'array',
        ];
    }

    public function embeddable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeForCollection(Builder $query, string $collection): Builder
    {
        return $query->where('collection', $collection);
    }

    public function scopeForEmbeddable(Builder $query, Model $model): Builder
    {
        return $query->where('embeddable_type', $model->getMorphClass())
            ->where('embeddable_id', $model->getKey());
    }
}
