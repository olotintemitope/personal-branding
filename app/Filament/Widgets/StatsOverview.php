<?php

namespace App\Filament\Widgets;

use App\Enums\Currency;
use App\Enums\InvoiceStatus;
use App\Enums\MeetingStatus;
use App\Enums\ProjectStatus;
use App\Models\Invoice;
use App\Models\Meeting;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $pendingInvoices = Invoice::whereIn('status', [InvoiceStatus::Sent, InvoiceStatus::Overdue]);
        $paidInvoices = Invoice::where('status', InvoiceStatus::Paid);

        // Group outstanding by currency
        $outstandingByCurrency = (clone $pendingInvoices)->get()
            ->groupBy(fn ($inv) => ($inv->currency ?? Currency::USD)->value)
            ->map(fn ($group) => $group->sum('total'));

        $outstandingDesc = $outstandingByCurrency->map(function ($total, $code) {
            $currency = Currency::tryFrom($code) ?? Currency::USD;

            return $currency->format($total);
        })->implode(' | ');

        // Group revenue by currency
        $revenueByCurrency = (clone $paidInvoices)->get()
            ->groupBy(fn ($inv) => ($inv->currency ?? Currency::USD)->value)
            ->map(fn ($group) => $group->sum('total'));

        $revenueDesc = $revenueByCurrency->map(function ($total, $code) {
            $currency = Currency::tryFrom($code) ?? Currency::USD;

            return $currency->format($total);
        })->implode(' | ');

        return [
            Stat::make('Active Projects', Project::where('status', ProjectStatus::InProgress)->count())
                ->description('Currently in progress')
                ->icon('heroicon-o-briefcase')
                ->color('primary'),

            Stat::make('Pending Invoices', $pendingInvoices->count())
                ->description($outstandingDesc ?: '$0.00 outstanding')
                ->icon('heroicon-o-document-currency-dollar')
                ->color('warning'),

            Stat::make('Total Revenue', $revenueDesc ?: '$0.00')
                ->description('From paid invoices')
                ->icon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Upcoming Meetings', Meeting::where('status', MeetingStatus::Scheduled)->where('scheduled_at', '>=', now())->count())
                ->description('Scheduled ahead')
                ->icon('heroicon-o-calendar-days')
                ->color('info'),
        ];
    }
}
