<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestProjectsWidget;
use App\Filament\Widgets\OverdueInvoicesWidget;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\UpcomingMeetingsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getTitle(): string
    {
        $hour = now()->hour;
        $greeting = match (true) {
            $hour < 12 => 'Good morning',
            $hour < 17 => 'Good afternoon',
            default => 'Good evening',
        };

        $name = auth()->user()?->name ?? 'there';
        $firstName = explode(' ', $name)[0];

        return "{$greeting}, {$firstName}";
    }

    public function getSubheading(): ?string
    {
        return now()->format('l, F j, Y');
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            LatestProjectsWidget::class,
            OverdueInvoicesWidget::class,
            UpcomingMeetingsWidget::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 2;
    }
}
