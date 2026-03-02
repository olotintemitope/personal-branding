<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Enums\MeetingStatus;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class MeetingsRelationManager extends RelationManager
{
    protected static string $relationship = 'meetings';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->maxLength(65535)
                ->columnSpanFull(),

            Forms\Components\DateTimePicker::make('scheduled_at'),

            Forms\Components\TextInput::make('duration_minutes')
                ->numeric()
                ->default(30),

            Forms\Components\TextInput::make('location')
                ->maxLength(255),

            Forms\Components\Textarea::make('notes')
                ->maxLength(65535)
                ->columnSpanFull(),

            Forms\Components\Select::make('status')
                ->options(MeetingStatus::class)
                ->default(MeetingStatus::Scheduled)
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('scheduled_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration_minutes')
                    ->label('Duration (min)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('markCompleted')
                    ->label('Mark Completed')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === MeetingStatus::Scheduled)
                    ->action(fn ($record) => $record->update(['status' => MeetingStatus::Completed])),
                Action::make('cancel')
                    ->label('Cancel')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === MeetingStatus::Scheduled)
                    ->action(fn ($record) => $record->update(['status' => MeetingStatus::Cancelled])),
                DeleteAction::make(),
            ]);
    }
}
