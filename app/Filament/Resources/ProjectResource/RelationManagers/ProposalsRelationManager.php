<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Enums\Currency;
use App\Enums\ProposalStatus;
use App\Mail\ProposalMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class ProposalsRelationManager extends RelationManager
{
    protected static string $relationship = 'proposals';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\RichEditor::make('content')
                ->columnSpanFull(),

            Forms\Components\TextInput::make('amount')
                ->numeric()
                ->prefix(fn () => ($this->getOwnerRecord()->currency ?? Currency::USD)->symbol()),

            Forms\Components\Select::make('status')
                ->options(ProposalStatus::class)
                ->default(ProposalStatus::Draft)
                ->required(),

            Forms\Components\DatePicker::make('valid_until'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->money()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sent_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('valid_until')
                    ->date()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('send')
                    ->label('Send')
                    ->icon('heroicon-o-paper-airplane')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === ProposalStatus::Draft)
                    ->action(function ($record) {
                        $record->update([
                            'status' => ProposalStatus::Sent,
                            'sent_at' => now(),
                        ]);

                        $client = $this->getOwnerRecord()->client;

                        if ($client?->email) {
                            $record->load('project.client');
                            Mail::to($client->email)->send(new ProposalMail($record));
                        }

                        Notification::make()
                            ->success()
                            ->title('Proposal sent to ' . ($client?->name ?? 'client'))
                            ->send();
                    }),
                Action::make('downloadPdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($record) {
                        $record->load('project.client');
                        $pdf = Pdf::loadView('pdf.proposal', ['proposal' => $record]);

                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            "proposal-{$record->id}.pdf"
                        );
                    }),
                DeleteAction::make(),
            ]);
    }
}
