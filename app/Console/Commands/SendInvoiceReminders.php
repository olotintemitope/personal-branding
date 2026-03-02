<?php

namespace App\Console\Commands;

use App\Enums\InvoiceStatus;
use App\Mail\InvoiceReminderMail;
use App\Models\Invoice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendInvoiceReminders extends Command
{
    protected $signature = 'app:send-invoice-reminders {--days=7 : Number of days overdue before sending reminder}';

    protected $description = 'Send payment reminders for overdue invoices';

    public function handle(): int
    {
        $days = (int) $this->option('days');

        $invoices = Invoice::with('client')
            ->whereIn('status', [InvoiceStatus::Sent, InvoiceStatus::Overdue])
            ->where('due_date', '<=', now()->subDays($days))
            ->where(function ($query) {
                $query->whereNull('last_reminder_sent_at')
                    ->orWhere('last_reminder_sent_at', '<=', now()->subDays(7));
            })
            ->get();

        $count = 0;

        foreach ($invoices as $invoice) {
            if (! $invoice->client?->email) {
                $this->warn("Skipping invoice {$invoice->invoice_number} — no client email.");
                continue;
            }

            Mail::to($invoice->client->email)->send(new InvoiceReminderMail($invoice));
            $invoice->update([
                'last_reminder_sent_at' => now(),
                'status' => InvoiceStatus::Overdue,
            ]);
            $count++;

            $this->info("Reminder sent for invoice {$invoice->invoice_number} to {$invoice->client->email}");
        }

        $this->info("Done. {$count} reminder(s) sent.");

        return self::SUCCESS;
    }
}
