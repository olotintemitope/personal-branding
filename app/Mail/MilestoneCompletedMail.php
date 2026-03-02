<?php

namespace App\Mail;

use App\Models\Milestone;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MilestoneCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Milestone $milestone) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Milestone Completed: {$this->milestone->title}",
        );
    }

    public function content(): Content
    {
        $project = $this->milestone->project;

        return new Content(
            view: 'emails.milestone-completed',
            with: [
                'milestone' => $this->milestone,
                'project' => $project,
                'completionPercentage' => $project->completionPercentage(),
                'remainingMilestones' => $project->milestones()->whereNull('completed_at')->get(),
            ],
        );
    }
}
