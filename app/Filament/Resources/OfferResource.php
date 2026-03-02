<?php

namespace App\Filament\Resources;

use App\Enums\Currency;
use App\Enums\OfferStatus;
use App\Filament\Resources\OfferResource\Pages;
use App\Models\Offer;
use App\Models\Project;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static string | UnitEnum | null $navigationGroup = 'Invoices';

    public static function canAccess(): bool
    {
        return auth()->user()?->can('view offers') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create offers') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('edit offers') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('delete offers') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('offer_number')
                ->default(fn () => Offer::generateOfferNumber())
                ->disabled(fn (string $operation): bool => $operation === 'edit')
                ->dehydrated()
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('client_id')
                ->label('Client')
                ->relationship('client', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->reactive()
                ->afterStateUpdated(fn (Set $set) => $set('project_id', null)),

            Forms\Components\Select::make('project_id')
                ->label('Project')
                ->options(fn (Get $get): array => Project::query()
                    ->where('client_id', $get('client_id'))
                    ->pluck('title', 'id')
                    ->toArray())
                ->searchable()
                ->preload()
                ->required()
                ->visible(fn (Get $get): bool => filled($get('client_id'))),

            Forms\Components\Hidden::make('user_id')
                ->default(auth()->id()),

            Forms\Components\Select::make('status')
                ->options(OfferStatus::class)
                ->default(OfferStatus::Draft)
                ->required(),

            Forms\Components\DatePicker::make('valid_until')
                ->default(now()->addDays(30)),

            Forms\Components\Select::make('currency')
                ->options(Currency::class)
                ->default(Currency::USD)
                ->required()
                ->reactive(),

            Forms\Components\TextInput::make('tax_rate')
                ->label('Tax / VAT Rate')
                ->numeric()
                ->suffix('%')
                ->default(0),

            Forms\Components\RichEditor::make('cover_letter')
                ->columnSpanFull(),

            Forms\Components\Repeater::make('items')
                ->relationship()
                ->schema([
                    Forms\Components\TextInput::make('milestone_title')
                        ->label('Milestone')
                        ->required()
                        ->columnSpan(2),
                    Forms\Components\Textarea::make('description')
                        ->rows(2)
                        ->columnSpan(2),
                    Forms\Components\TextInput::make('estimated_hours')
                        ->label('Est. Hours')
                        ->numeric()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn (Set $set, Get $get) => $set('amount', round(($get('estimated_hours') ?? 0) * ($get('hourly_rate') ?? 0), 2))),
                    Forms\Components\TextInput::make('hourly_rate')
                        ->label('Rate/hr')
                        ->numeric()
                        ->prefix(function (Get $get): string {
                            $val = $get('../../currency');
                            if ($val instanceof Currency) return $val->symbol();
                            return (Currency::tryFrom($val ?? 'USD') ?? Currency::USD)->symbol();
                        })
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn (Set $set, Get $get) => $set('amount', round(($get('estimated_hours') ?? 0) * ($get('hourly_rate') ?? 0), 2))),
                    Forms\Components\TextInput::make('amount')
                        ->numeric()
                        ->prefix(function (Get $get): string {
                            $val = $get('../../currency');
                            if ($val instanceof Currency) return $val->symbol();
                            return (Currency::tryFrom($val ?? 'USD') ?? Currency::USD)->symbol();
                        })
                        ->disabled()
                        ->dehydrated(),
                ])
                ->columns(4)
                ->defaultItems(1)
                ->reorderable()
                ->orderColumn('sort_order')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('offer_number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('project.title')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total')
                    ->money()
                    ->sortable(),

                Tables\Columns\TextColumn::make('valid_until')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(OfferStatus::class),

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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
