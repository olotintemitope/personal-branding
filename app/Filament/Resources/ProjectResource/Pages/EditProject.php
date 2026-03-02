<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Enums\ProjectStatus;
use App\Filament\Resources\ProjectResource;
use App\Mail\ProjectCompletedMail;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

            Actions\Action::make('taskBoard')
                ->label('Task Board')
                ->icon('heroicon-o-view-columns')
                ->color('info')
                ->url(fn () => ProjectResource::getUrl('task-board', ['record' => $this->getRecord()])),

            Actions\Action::make('completeProject')
                ->label('Complete Project')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->requiresConfirmation()
                ->modalDescription('This will mark the project as completed and notify the client. Continue?')
                ->visible(fn () => $this->getRecord()->status === ProjectStatus::InProgress)
                ->action(function () {
                    $record = $this->getRecord();

                    $unpaidInvoices = $record->invoices()
                        ->whereNotIn('status', ['paid', 'cancelled'])
                        ->count();

                    if ($unpaidInvoices > 0) {
                        Notification::make()
                            ->warning()
                            ->title("Warning: {$unpaidInvoices} unpaid invoice(s)")
                            ->body('The project has been completed but there are outstanding invoices.')
                            ->persistent()
                            ->send();
                    }

                    $record->update([
                        'status' => ProjectStatus::Completed,
                        'completed_at' => now(),
                    ]);

                    $client = $record->client;
                    if ($client?->email) {
                        Mail::to($client->email)
                            ->send(new ProjectCompletedMail($record->fresh()));
                    }

                    Notification::make()->success()->title('Project marked as completed!')->send();
                }),
        ];
    }
}
