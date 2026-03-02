<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class UpdatesRelationManager extends RelationManager
{
    protected static string $relationship = 'updates';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\RichEditor::make('content')
                ->columnSpanFull(),

            Forms\Components\Toggle::make('sent_to_client')
                ->default(false),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('sent_to_client')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sent_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('sendToClient')
                    ->label('Send to Client')
                    ->icon('heroicon-o-paper-airplane')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => !$record->sent_to_client)
                    ->action(function ($record) {
                        $record->update(['sent_to_client' => true, 'sent_at' => now()]);
                        $client = $record->project->client;
                        if ($client?->email) {
                            Mail::to($client->email)
                                ->send(new \App\Mail\ProjectUpdateMail($record));
                        }
                    }),
                DeleteAction::make(),
            ]);
    }
}
