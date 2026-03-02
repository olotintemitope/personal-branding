<?php

namespace App\Filament\Widgets;

use App\Enums\Currency;
use App\Enums\InvoiceStatus;
use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class OverdueInvoicesWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 1;

    protected static ?string $heading = 'Unpaid & Overdue Invoices';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Invoice::query()
                    ->whereIn('status', [InvoiceStatus::Sent, InvoiceStatus::Overdue])
                    ->with('client')
                    ->orderBy('due_date')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Invoice #'),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('total')
                    ->formatStateUsing(fn (Invoice $record) => ($record->currency ?? Currency::USD)->format($record->total))
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('view')
                    ->url(fn (Invoice $record) => InvoiceResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-o-eye'),
            ])
            ->paginated(false);
    }
}
