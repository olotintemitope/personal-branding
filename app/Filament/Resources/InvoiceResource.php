<?php

namespace App\Filament\Resources;

use App\Enums\Currency;
use App\Enums\InvoiceStatus;
use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
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

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-currency-dollar';

    protected static string | UnitEnum | null $navigationGroup = 'Invoices';

    public static function canAccess(): bool
    {
        return auth()->user()?->can('view invoices') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create invoices') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('edit invoices') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('delete invoices') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('invoice_number')
                ->default(fn () => Invoice::generateInvoiceNumber())
                ->disabled(fn (string $operation): bool => $operation === 'edit')
                ->dehydrated()
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
                ->visible(fn (Get $get): bool => filled($get('client_id'))),

            Forms\Components\Hidden::make('user_id')
                ->default(auth()->id()),

            Forms\Components\Select::make('status')
                ->options(InvoiceStatus::class)
                ->default(InvoiceStatus::Draft)
                ->required(),

            Forms\Components\DatePicker::make('issue_date')
                ->default(now())
                ->required(),

            Forms\Components\DatePicker::make('due_date')
                ->default(now()->addDays(30))
                ->required(),

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

            Forms\Components\TextInput::make('vat_number')
                ->label('VAT Number')
                ->maxLength(50)
                ->placeholder('e.g. NG-1234567890'),

            Forms\Components\Textarea::make('notes')
                ->maxLength(65535)
                ->columnSpanFull(),

            Forms\Components\Repeater::make('items')
                ->relationship()
                ->schema([
                    Forms\Components\TextInput::make('description')->required()->columnSpan(2),
                    Forms\Components\TextInput::make('quantity')->numeric()->default(1)->required(),
                    Forms\Components\TextInput::make('unit_price')
                        ->numeric()
                        ->prefix(function (Get $get): string {
                            $val = $get('../../currency');
                            if ($val instanceof Currency) return $val->symbol();
                            return (Currency::tryFrom($val ?? 'USD') ?? Currency::USD)->symbol();
                        })
                        ->required(),
                ])
                ->columns(4)
                ->defaultItems(1)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('issue_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total')
                    ->money()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(InvoiceStatus::class),

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
