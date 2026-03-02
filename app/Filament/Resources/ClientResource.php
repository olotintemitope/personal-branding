<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user-group';

    protected static string | UnitEnum | null $navigationGroup = 'Projects';

    public static function canAccess(): bool
    {
        return auth()->user()?->can('view clients') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create clients') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('edit clients') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('delete clients') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Client Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('phone')
                        ->tel()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('company')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('vat_number')
                        ->label('VAT / Tax ID')
                        ->maxLength(50)
                        ->placeholder('e.g. NG-1234567890'),

                    Forms\Components\TextInput::make('website')
                        ->url()
                        ->maxLength(255),

                    Forms\Components\Textarea::make('notes')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Brand')
                ->schema([
                    Forms\Components\SpatieMediaLibraryFileUpload::make('brand_logo')
                        ->collection('brand_logo')
                        ->image()
                        ->label('Brand Logo'),

                    Forms\Components\ColorPicker::make('brand_color')
                        ->label('Brand Color'),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('brand_assets')
                        ->collection('brand_assets')
                        ->multiple()
                        ->label('Brand Assets')
                        ->helperText('Upload logos, style guides, or other brand materials')
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('brand_guidelines')
                        ->label('Brand Guidelines / Notes')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('brand_logo')
                    ->collection('brand_logo')
                    ->label('Logo')
                    ->circular()
                    ->size(32),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('company')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ColorColumn::make('brand_color')
                    ->label('Brand'),

                Tables\Columns\TextColumn::make('projects_count')
                    ->counts('projects')
                    ->label('Projects')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            RelationManagers\ProjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
