<?php

namespace App\Models;

use App\Enums\ProposalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'content',
        'amount',
        'status',
        'sent_at',
        'valid_until',
    ];

    protected function casts(): array
    {
        return [
            'status' => ProposalStatus::class,
            'amount' => 'decimal:2',
            'sent_at' => 'datetime',
            'valid_until' => 'date',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
