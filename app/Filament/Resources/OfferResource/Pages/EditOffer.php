<?php

namespace App\Filament\Resources\OfferResource\Pages;

use App\Enums\OfferStatus;
use App\Filament\Resources\InvoiceResource;
use App\Filament\Resources\OfferResource;
use App\Mail\OfferMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditOffer extends EditRecord
{
    protected static string $resource = OfferResource::class;

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
                    $pdf = Pdf::loadView('pdf.offer', ['offer' => $record]);

                    return response()->streamDownload(
                        fn () => print($pdf->output()),
                        "offer-{$record->offer_number}.pdf"
                    );
                }),

            Actions\Action::make('sendOffer')
                ->label('Send Offer')
                ->icon('heroicon-o-envelope')
                ->requiresConfirmation()
                ->visible(fn () => in_array($this->getRecord()->status, [OfferStatus::Draft, OfferStatus::Sent]))
                ->action(function () {
                    $record = $this->getRecord();
                    $client = $record->client;

                    if ($client?->email) {
                        Mail::to($client->email)->send(new OfferMail($record));
                    }

                    if ($record->status === OfferStatus::Draft) {
                        $record->update([
                            'status' => OfferStatus::Sent,
                            'sent_at' => now(),
                        ]);
                    }

                    Notification::make()->success()->title('Offer sent!')->send();
                }),

            Actions\Action::make('markAccepted')
                ->label('Mark Accepted')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn () => $this->getRecord()->status === OfferStatus::Sent)
                ->action(function () {
                    $this->getRecord()->update([
                        'status' => OfferStatus::Accepted,
                        'accepted_at' => now(),
                    ]);

                    Notification::make()->success()->title('Offer marked as accepted!')->send();
                }),

            Actions\Action::make('markRejected')
                ->label('Mark Rejected')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn () => $this->getRecord()->status === OfferStatus::Sent)
                ->action(function () {
                    $this->getRecord()->update([
                        'status' => OfferStatus::Rejected,
                    ]);

                    Notification::make()->success()->title('Offer marked as rejected.')->send();
                }),

            Actions\Action::make('convertToInvoice')
                ->label('Convert to Invoice')
                ->icon('heroicon-o-document-currency-dollar')
                ->color('primary')
                ->requiresConfirmation()
                ->modalDescription('This will create a new invoice from this offer with all line items. Continue?')
                ->visible(fn () => $this->getRecord()->status === OfferStatus::Accepted)
                ->action(function () {
                    $invoice = $this->getRecord()->convertToInvoice();

                    Notification::make()->success()->title('Invoice created!')->send();

                    return redirect(InvoiceResource::getUrl('edit', ['record' => $invoice]));
                }),
        ];
    }

    protected function afterSave(): void
    {
        $this->getRecord()->calculateTotals();
    }
}
