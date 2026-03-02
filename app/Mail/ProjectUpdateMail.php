<?php

namespace App\Mail;

use App\Models\ProjectUpdate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ProjectUpdate $projectUpdate) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Project Update: {$this->projectUpdate->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.project-update',
            with: [
                'update' => $this->projectUpdate,
                'project' => $this->projectUpdate->project,
            ],
        );
    }
}
