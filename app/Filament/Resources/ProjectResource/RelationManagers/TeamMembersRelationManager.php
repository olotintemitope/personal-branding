<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Enums\TeamRole;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class TeamMembersRelationManager extends RelationManager
{
    protected static string $relationship = 'teamMembers';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pivot.role')
                    ->label('Project Role')
                    ->badge()
                    ->formatStateUsing(fn (?string $state) => $state ? TeamRole::tryFrom($state)?->getLabel() : '—'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Select::make('role')
                            ->label('Project Role')
                            ->options(TeamRole::class),
                    ]),
            ])
            ->recordActions([
                DetachAction::make(),
            ]);
    }
}
