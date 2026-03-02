<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Enums\Currency;
use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'projects';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\Hidden::make('user_id')
                ->default(auth()->id()),

            Forms\Components\Select::make('status')
                ->options(ProjectStatus::class)
                ->default(ProjectStatus::Planning)
                ->required(),

            Forms\Components\Select::make('project_type')
                ->label('Project Type')
                ->options(ProjectType::class)
                ->required(),

            Forms\Components\Select::make('currency')
                ->options(Currency::class)
                ->default(Currency::USD)
                ->required()
                ->reactive(),

            Forms\Components\DatePicker::make('start_date'),

            Forms\Components\DatePicker::make('end_date'),

            Forms\Components\TextInput::make('budget')
                ->numeric()
                ->prefix(function (Get $get): string {
                    $val = $get('currency');
                    if ($val instanceof Currency) {
                        return $val->symbol();
                    }

                    return (Currency::tryFrom((string) ($val ?? 'USD')) ?? Currency::USD)->symbol();
                }),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('budget')
                    ->money()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
