<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'client_id',
        'user_id',
        'status',
        'project_type',
        'start_date',
        'end_date',
        'budget',
        'currency',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
            'project_type' => ProjectType::class,
            'currency' => Currency::class,
            'start_date' => 'date',
            'end_date' => 'date',
            'budget' => 'decimal:2',
            'completed_at' => 'datetime',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(Milestone::class)->orderBy('sort_order');
    }

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ProjectDocument::class);
    }

    public function updates(): HasMany
    {
        return $this->hasMany(ProjectUpdate::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function teamMembers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function completionPercentage(): int
    {
        $total = $this->milestones()->count();

        if ($total === 0) {
            return 0;
        }

        $completed = $this->milestones()->whereNotNull('completed_at')->count();

        return (int) round(($completed / $total) * 100);
    }

    public function taskCompletionPercentage(): int
    {
        $total = $this->tasks()->count();

        if ($total === 0) {
            return 0;
        }

        $completed = $this->tasks()->where('status', 'completed')->count();

        return (int) round(($completed / $total) * 100);
    }

    public function totalEstimatedHours(): float
    {
        return (float) $this->tasks()->sum('estimated_hours');
    }

    public function totalActualHours(): float
    {
        return (float) $this->tasks()->sum('actual_hours');
    }
}
