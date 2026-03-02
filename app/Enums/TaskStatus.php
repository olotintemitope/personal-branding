<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TaskStatus: string implements HasColor, HasLabel
{
    case Todo = 'todo';
    case InProgress = 'in_progress';
    case InReview = 'in_review';
    case Completed = 'completed';
    case Blocked = 'blocked';

    public function getLabel(): string
    {
        return match ($this) {
            self::Todo => 'To Do',
            self::InProgress => 'In Progress',
            self::InReview => 'In Review',
            self::Completed => 'Completed',
            self::Blocked => 'Blocked',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Todo => 'gray',
            self::InProgress => 'primary',
            self::InReview => 'warning',
            self::Completed => 'success',
            self::Blocked => 'danger',
        };
    }
}
