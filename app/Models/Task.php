<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'milestone_id',
        'assigned_to',
        'created_by',
        'title',
        'description',
        'status',
        'priority',
        'estimated_hours',
        'actual_hours',
        'started_at',
        'completed_at',
        'due_date',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class,
            'priority' => TaskPriority::class,
            'estimated_hours' => 'decimal:2',
            'actual_hours' => 'decimal:2',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'due_date' => 'date',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function milestone(): BelongsTo
    {
        return $this->belongsTo(Milestone::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updates(): HasMany
    {
        return $this->hasMany(TaskUpdate::class)->orderByDesc('created_at');
    }

    public function timeSpentPercentage(): int
    {
        if (! $this->estimated_hours || $this->estimated_hours == 0) {
            return 0;
        }

        return min(100, (int) round(($this->actual_hours / $this->estimated_hours) * 100));
    }

    public function isOvertime(): bool
    {
        return $this->estimated_hours && $this->actual_hours > $this->estimated_hours;
    }

    public function logTime(float $hours, string $content, ?int $userId = null): TaskUpdate
    {
        $update = $this->updates()->create([
            'user_id' => $userId ?? auth()->id(),
            'content' => $content,
            'hours_logged' => $hours,
        ]);

        $this->increment('actual_hours', $hours);

        return $update;
    }
}
