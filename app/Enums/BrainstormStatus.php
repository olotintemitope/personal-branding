<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BrainstormStatus: string implements HasColor, HasLabel
{
    case Brainstorming = 'brainstorming';
    case SpecGenerated = 'spec_generated';
    case Completed = 'completed';

    public function getLabel(): string
    {
        return match ($this) {
            self::Brainstorming => 'Brainstorming',
            self::SpecGenerated => 'Spec Generated',
            self::Completed => 'Completed',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Brainstorming => 'warning',
            self::SpecGenerated => 'info',
            self::Completed => 'success',
        };
    }
}
