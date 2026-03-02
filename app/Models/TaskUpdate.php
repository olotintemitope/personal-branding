<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TaskUpdate extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'task_id',
        'user_id',
        'content',
        'hours_logged',
        'status_change',
    ];

    protected function casts(): array
    {
        return [
            'hours_logged' => 'decimal:2',
        ];
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('recordings')
            ->acceptsMimeTypes([
                'video/mp4', 'video/webm', 'video/quicktime',
                'audio/mpeg', 'audio/wav',
            ]);

        $this->addMediaCollection('attachments')
            ->acceptsMimeTypes([
                'image/jpeg', 'image/png', 'image/gif', 'image/webp',
                'application/pdf',
                'text/plain',
                'application/zip',
            ]);
    }
}
