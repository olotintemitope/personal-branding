<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class BrainstormPage extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-light-bulb';

    protected static string | UnitEnum | null $navigationGroup = 'AI Tools';

    protected static ?string $navigationLabel = 'Brainstorm';

    protected static ?string $title = 'AI Brainstorm & Spec Generator';

    protected static ?string $slug = 'brainstorm';

    protected string $view = 'filament.pages.brainstorm';

    public static function canAccess(): bool
    {
        return auth()->user()?->can('use brainstorm') ?? false;
    }
}
