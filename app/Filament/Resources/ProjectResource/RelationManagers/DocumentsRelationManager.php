<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->maxLength(65535)
                ->columnSpanFull(),

            Forms\Components\Select::make('type')
                ->options([
                    'note' => 'Note',
                    'file' => 'File',
                    'link' => 'Link',
                ])
                ->required()
                ->live(),

            Forms\Components\Textarea::make('content')
                ->maxLength(65535)
                ->columnSpanFull()
                ->visible(fn (Get $get) => $get('type') === 'note'),

            Forms\Components\TextInput::make('url')
                ->label('URL')
                ->maxLength(255)
                ->visible(fn (Get $get) => $get('type') === 'link'),

            Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                ->collection('documents')
                ->columnSpanFull()
                ->visible(fn (Get $get) => $get('type') === 'file'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->visible(fn ($record) => $record->type === 'file')
                    ->action(function ($record) {
                        $media = $record->getFirstMedia('documents');

                        if ($media) {
                            return response()->streamDownload(
                                fn () => print(file_get_contents($media->getPath())),
                                $media->file_name
                            );
                        }
                    }),
                Action::make('openLink')
                    ->label('Open Link')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->visible(fn ($record) => $record->type === 'link' && $record->url)
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
