<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeadlineRiskAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Project $project,
        public string $analysis,
        public array $projectData,
    ) {}

    public function envelope(): Envelope
    {
        $daysLeft = $this->projectData['days_remaining'];
        $urgency = $daysLeft < 7 ? 'URGENT' : 'Alert';

        return new Envelope(
            subject: "[{$urgency}] Deadline Risk: {$this->project->title} — {$daysLeft} days remaining",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.deadline-risk-alert',
            with: [
                'project' => $this->project,
                'analysis' => $this->analysis,
                'data' => $this->projectData,
            ],
        );
    }
}
