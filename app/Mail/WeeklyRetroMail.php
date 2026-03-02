<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeeklyRetroMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Project $project,
        public string $retroContent,
        public array $projectData,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Weekly Retro: {$this->project->title} — " . now()->format('M d, Y'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.weekly-retro',
            with: [
                'project' => $this->project,
                'retroContent' => $this->retroContent,
                'data' => $this->projectData,
            ],
        );
    }
}
