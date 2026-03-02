<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Project $project) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Project Completed: {$this->project->title}",
        );
    }

    public function content(): Content
    {
        $this->project->load(['milestones', 'invoices', 'client']);

        return new Content(
            view: 'emails.project-completed',
            with: [
                'project' => $this->project,
                'totalMilestones' => $this->project->milestones->count(),
                'unpaidInvoices' => $this->project->invoices->where('status', '!=', 'paid'),
            ],
        );
    }
}
