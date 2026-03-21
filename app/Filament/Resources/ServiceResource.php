<?php

namespace App\Filament\Resources;

use App\Enums\Currency;
use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | UnitEnum | null $navigationGroup = 'Website';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Section::make('Service Details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('description')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('price_unit')
                        ->placeholder('e.g. per hour, per project, per month')
                        ->maxLength(50),

                    Forms\Components\TextInput::make('badge')
                        ->placeholder('e.g. Most Popular')
                        ->maxLength(50),

                    Forms\Components\TextInput::make('cta_label')
                        ->default('Get Started')
                        ->required()
                        ->maxLength(50),

                    Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_featured')
                        ->label('Featured (highlighted card)'),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ]),

            Forms\Components\Section::make('Pricing (Multi-Currency)')
                ->description('Set the price in each currency. Leave blank for currencies you don\'t want to display.')
                ->columns(3)
                ->schema(
                    collect(Currency::cases())->map(fn (Currency $currency) =>
                        Forms\Components\TextInput::make("prices.{$currency->value}")
                            ->label($currency->getLabel())
                            ->numeric()
                            ->prefix($currency->symbol())
                    )->all()
                ),

            Forms\Components\Section::make('Features')
                ->description('Bullet points shown on the pricing card')
                ->schema([
                    Forms\Components\Repeater::make('features')
                        ->simple(
                            Forms\Components\TextInput::make('feature')
                                ->required()
                        )
                        ->defaultItems(3)
                        ->reorderable()
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable()
                    ->width(50),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('prices')
                    ->label('Price (USD)')
                    ->formatStateUsing(fn ($state) => isset($state['USD']) ? '$' . number_format((float) $state['USD']) : '—'),

                Tables\Columns\TextColumn::make('price_unit')
                    ->label('Unit'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
