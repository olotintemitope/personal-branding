<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Enums\InvoiceStatus;
use App\Filament\Resources\InvoiceResource;
use App\Mail\InvoiceMail;
use App\Mail\InvoiceReminderMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

            Actions\Action::make('downloadPdf')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $record = $this->getRecord();
                    $record->load(['client', 'items', 'project']);
                    $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $record]);

                    return response()->streamDownload(
                        fn () => print($pdf->output()),
                        "invoice-{$record->invoice_number}.pdf"
                    );
                }),

            Actions\Action::make('sendInvoice')
                ->label('Send Invoice')
                ->icon('heroicon-o-envelope')
                ->requiresConfirmation()
                ->visible(fn () => in_array($this->getRecord()->status, [InvoiceStatus::Draft, InvoiceStatus::Sent]))
                ->action(function () {
                    $record = $this->getRecord();
                    $client = $record->client;

                    if ($client?->email) {
                        Mail::to($client->email)
                            ->send(new InvoiceMail($record));
                    }

                    if ($record->status === InvoiceStatus::Draft) {
                        $record->update(['status' => InvoiceStatus::Sent]);
                    }

                    Notification::make()->success()->title('Invoice sent!')->send();
                }),

            Actions\Action::make('sendReminder')
                ->label('Send Reminder')
                ->icon('heroicon-o-bell-alert')
                ->color('warning')
                ->requiresConfirmation()
                ->visible(fn () => in_array($this->getRecord()->status, [InvoiceStatus::Sent, InvoiceStatus::Overdue]))
                ->action(function () {
                    $record = $this->getRecord();
                    $client = $record->client;

                    if ($client?->email) {
                        Mail::to($client->email)
                            ->send(new InvoiceReminderMail($record));
                    }

                    $record->update(['last_reminder_sent_at' => now()]);

                    Notification::make()->success()->title('Reminder sent!')->send();
                }),

            Actions\Action::make('markPaid')
                ->label('Mark as Paid')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn () => $this->getRecord()->status !== InvoiceStatus::Paid)
                ->action(function () {
                    $this->getRecord()->update([
                        'status' => InvoiceStatus::Paid,
                        'paid_at' => now(),
                    ]);

                    Notification::make()->success()->title('Invoice marked as paid!')->send();
                }),
        ];
    }

    protected function afterSave(): void
    {
        $this->getRecord()->calculateTotals();
    }
}
