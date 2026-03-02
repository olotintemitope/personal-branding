<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TeamRole: string implements HasColor, HasLabel
{
    case Admin = 'admin';
    case ProjectManager = 'project_manager';
    case Developer = 'developer';
    case Designer = 'designer';

    public function getLabel(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::ProjectManager => 'Project Manager',
            self::Developer => 'Developer',
            self::Designer => 'Designer',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Admin => 'danger',
            self::ProjectManager => 'primary',
            self::Developer => 'success',
            self::Designer => 'info',
        };
    }
}
