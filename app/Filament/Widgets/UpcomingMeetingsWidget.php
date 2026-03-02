<?php

namespace App\Filament\Widgets;

use App\Enums\MeetingStatus;
use App\Models\Meeting;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingMeetingsWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 1;

    protected static ?string $heading = 'Upcoming Meetings';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Meeting::query()
                    ->where('status', MeetingStatus::Scheduled)
                    ->where('scheduled_at', '>=', now())
                    ->with('project')
                    ->orderBy('scheduled_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->wrap(),
                Tables\Columns\TextColumn::make('scheduled_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_minutes')
                    ->label('Duration')
                    ->suffix(' min'),
            ])
            ->paginated(false);
    }
}
