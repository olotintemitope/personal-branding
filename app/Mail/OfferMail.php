<?php

namespace App\Mail;

use App\Models\Offer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OfferMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Offer $offer) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Offer {$this->offer->offer_number} — {$this->offer->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.offer',
            with: [
                'offer' => $this->offer,
            ],
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $this->offer->load(['client', 'items', 'project']);
        $pdf = Pdf::loadView('pdf.offer', ['offer' => $this->offer]);

        return [
            Attachment::fromData(
                fn () => $pdf->output(),
                "offer-{$this->offer->offer_number}.pdf"
            )->withMime('application/pdf'),
        ];
    }
}
