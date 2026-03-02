<?php

namespace App\Filament\Widgets;

use App\Enums\Currency;
use App\Enums\ProjectStatus;
use App\Filament\Resources\ProjectResource;
use App\Models\Project;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestProjectsWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Latest Active Projects';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::query()
                    ->where('status', ProjectStatus::InProgress)
                    ->with('client')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client'),
                Tables\Columns\TextColumn::make('project_type')
                    ->label('Type')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date(),
                Tables\Columns\TextColumn::make('budget')
                    ->formatStateUsing(fn (Project $record) => ($record->currency ?? Currency::USD)->format($record->budget ?? 0))
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('view')
                    ->url(fn (Project $record) => ProjectResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-o-eye'),
            ])
            ->paginated(false);
    }
}
