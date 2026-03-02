<?php

namespace App\Filament\Resources;

use App\Enums\Currency;
use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';

    protected static string | UnitEnum | null $navigationGroup = 'Projects';

    public static function canAccess(): bool
    {
        return auth()->user()?->can('view projects') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create projects') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('edit projects') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('delete projects') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->maxLength(65535)
                ->columnSpanFull(),

            Forms\Components\Select::make('client_id')
                ->label('Client')
                ->relationship('client', 'name')
                ->searchable()
                ->preload()
                ->required(),

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('project_type')
                    ->label('Type')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('currency')
                    ->badge()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('budget')
                    ->money()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(ProjectStatus::class),

                Tables\Filters\SelectFilter::make('client')
                    ->relationship('client', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TeamMembersRelationManager::class,
            RelationManagers\TasksRelationManager::class,
            RelationManagers\MilestonesRelationManager::class,
            RelationManagers\MeetingsRelationManager::class,
            RelationManagers\OffersRelationManager::class,
            RelationManagers\ProposalsRelationManager::class,
            RelationManagers\DocumentsRelationManager::class,
            RelationManagers\UpdatesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            'task-board' => Pages\TaskBoard::route('/{record}/task-board'),
        ];
    }
}
