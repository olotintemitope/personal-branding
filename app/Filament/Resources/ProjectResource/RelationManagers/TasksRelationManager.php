<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
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
use Illuminate\Support\HtmlString;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            Forms\Components\Textarea::make('description')
                ->maxLength(65535)
                ->columnSpanFull(),

            Forms\Components\Select::make('milestone_id')
                ->label('Milestone')
                ->relationship('milestone', 'title')
                ->searchable()
                ->preload(),

            Forms\Components\Select::make('assigned_to')
                ->label('Assigned To')
                ->options(function ($livewire) {
                    $project = $livewire->getOwnerRecord();

                    return $project->teamMembers()->pluck('users.name', 'users.id')->toArray();
                })
                ->searchable()
                ->preload(),

            Forms\Components\Select::make('status')
                ->options(TaskStatus::class)
                ->default(TaskStatus::Todo)
                ->required(),

            Forms\Components\Select::make('priority')
                ->options(TaskPriority::class)
                ->default(TaskPriority::Medium)
                ->required(),

            Forms\Components\TextInput::make('estimated_hours')
                ->label('Est. Hours')
                ->numeric()
                ->suffix('hrs'),

            Forms\Components\DatePicker::make('due_date'),

            Forms\Components\Hidden::make('created_by')
                ->default(auth()->id()),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('assignee.name')
                    ->label('Assigned To')
                    ->sortable(),

                Tables\Columns\TextColumn::make('milestone.title')
                    ->label('Milestone')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('priority')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('estimated_hours')
                    ->label('Est.')
                    ->suffix('h')
                    ->sortable(),

                Tables\Columns\TextColumn::make('actual_hours')
                    ->label('Actual')
                    ->suffix('h')
                    ->sortable()
                    ->color(fn ($record) => $record->isOvertime() ? 'danger' : null),

                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(TaskStatus::class),

                Tables\Filters\SelectFilter::make('priority')
                    ->options(TaskPriority::class),

                Tables\Filters\SelectFilter::make('assigned_to')
                    ->label('Assigned To')
                    ->options(function ($livewire) {
                        $project = $livewire->getOwnerRecord();

                        return $project->teamMembers()->pluck('users.name', 'users.id')->toArray();
                    }),

                Tables\Filters\SelectFilter::make('milestone')
                    ->relationship('milestone', 'title'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                Action::make('logTime')
                    ->label('Log Time')
                    ->icon('heroicon-o-clock')
                    ->form([
                        Forms\Components\TextInput::make('hours')
                            ->label('Hours Worked')
                            ->numeric()
                            ->required()
                            ->minValue(0.25)
                            ->step(0.25),
                        Forms\Components\Textarea::make('content')
                            ->label('Update / Progress Note')
                            ->required(),
                        Forms\Components\FileUpload::make('recordings')
                            ->label('Video/Audio Recording (Optional)')
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime', 'audio/mpeg', 'audio/wav'])
                            ->directory('task-recordings')
                            ->preserveFilenames(),
                        Forms\Components\FileUpload::make('attachments')
                            ->multiple()
                            ->label('Attachments (Optional)')
                            ->directory('task-attachments')
                            ->preserveFilenames(),
                    ])
                    ->action(function ($record, array $data) {
                        $update = $record->logTime((float) $data['hours'], $data['content']);

                        foreach ((array) ($data['recordings'] ?? []) as $file) {
                            if ($file) {
                                $update->addMedia(storage_path('app/public/' . $file))
                                    ->toMediaCollection('recordings');
                            }
                        }

                        foreach ($data['attachments'] ?? [] as $file) {
                            if ($file) {
                                $update->addMedia(storage_path('app/public/' . $file))
                                    ->toMediaCollection('attachments');
                            }
                        }

                        Notification::make()
                            ->success()
                            ->title("Logged {$data['hours']}h on: {$record->title}")
                            ->send();
                    }),
                Action::make('start')
                    ->label('Start')
                    ->icon('heroicon-o-play')
                    ->color('primary')
                    ->visible(fn ($record) => $record->status === TaskStatus::Todo)
                    ->action(function ($record) {
                        $record->update([
                            'status' => TaskStatus::InProgress,
                            'started_at' => now(),
                        ]);

                        $record->updates()->create([
                            'user_id' => auth()->id(),
                            'content' => 'Task started.',
                            'status_change' => TaskStatus::InProgress->value,
                        ]);
                    }),
                Action::make('sendForReview')
                    ->label('Send for Review')
                    ->icon('heroicon-o-eye')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === TaskStatus::InProgress)
                    ->action(function ($record) {
                        $record->update([
                            'status' => TaskStatus::InReview,
                        ]);

                        $record->updates()->create([
                            'user_id' => auth()->id(),
                            'content' => 'Task sent for review.',
                            'status_change' => TaskStatus::InReview->value,
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Task sent for review')
                            ->send();
                    }),
                Action::make('complete')
                    ->label('Complete')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => in_array($record->status, [TaskStatus::InProgress, TaskStatus::InReview]))
                    ->action(function ($record) {
                        $record->update([
                            'status' => TaskStatus::Completed,
                            'completed_at' => now(),
                        ]);

                        $record->updates()->create([
                            'user_id' => auth()->id(),
                            'content' => 'Task completed.',
                            'status_change' => TaskStatus::Completed->value,
                        ]);
                    }),
                Action::make('viewHistory')
                    ->label('History')
                    ->icon('heroicon-o-clock')
                    ->color('gray')
                    ->modalHeading(fn ($record) => "History: {$record->title}")
                    ->modalContent(function ($record) {
                        $updates = $record->updates()->with('user')->orderByDesc('created_at')->get();

                        if ($updates->isEmpty()) {
                            return new HtmlString(
                                '<div style="text-align:center; padding:2.5rem 1rem;">'
                                . '<div style="width:48px; height:48px; margin:0 auto 1rem; border-radius:50%; background:linear-gradient(135deg, rgba(99,102,241,0.1), rgba(129,140,248,0.1)); display:flex; align-items:center; justify-content:center;">'
                                . '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6366f1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>'
                                . '</div>'
                                . '<p style="color:#94a3b8; font-size:0.875rem; font-weight:500;">No activity recorded yet.</p>'
                                . '</div>'
                            );
                        }

                        $totalHours = $updates->sum('hours_logged');

                        $html = '<div style="display:flex; flex-direction:column; gap:0;">';

                        // Summary bar
                        $html .= '<div style="display:flex; align-items:center; gap:1rem; padding:0.75rem 1rem; margin-bottom:1.25rem; background:linear-gradient(135deg, rgba(99,102,241,0.08), rgba(129,140,248,0.04)); border:1px solid rgba(99,102,241,0.12); border-radius:0.75rem;">';
                        $html .= '<div style="display:flex; align-items:center; gap:0.375rem;">';
                        $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#6366f1"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>';
                        $html .= '<span style="font-size:0.75rem; font-weight:600; color:#6366f1;">' . $updates->count() . ' update' . ($updates->count() !== 1 ? 's' : '') . '</span>';
                        $html .= '</div>';
                        if ($totalHours > 0) {
                            $html .= '<div style="width:1px; height:16px; background:rgba(99,102,241,0.15);"></div>';
                            $html .= '<div style="display:flex; align-items:center; gap:0.375rem;">';
                            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#10b981"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>';
                            $html .= '<span style="font-size:0.75rem; font-weight:600; color:#10b981;">' . number_format($totalHours, 1) . 'h total</span>';
                            $html .= '</div>';
                        }
                        $html .= '</div>';

                        // Timeline
                        $html .= '<div style="position:relative; padding-left:1.5rem;">';
                        // Timeline line
                        $html .= '<div style="position:absolute; left:0.4375rem; top:0.5rem; bottom:0.5rem; width:2px; background:linear-gradient(to bottom, rgba(99,102,241,0.3), rgba(99,102,241,0.05)); border-radius:1px;"></div>';

                        foreach ($updates as $i => $update) {
                            $isFirst = $i === 0;
                            $isTimeLog = $update->hours_logged > 0;
                            $isStatusChange = (bool) $update->status_change;

                            // Dot color
                            $dotColor = '#94a3b8';
                            $dotBg = 'rgba(148,163,184,0.15)';
                            if ($isFirst) {
                                $dotColor = '#6366f1';
                                $dotBg = 'rgba(99,102,241,0.15)';
                            } elseif ($isTimeLog) {
                                $dotColor = '#10b981';
                                $dotBg = 'rgba(16,185,129,0.15)';
                            } elseif ($isStatusChange) {
                                $dotColor = '#f59e0b';
                                $dotBg = 'rgba(245,158,11,0.15)';
                            }

                            $html .= '<div style="position:relative; padding-bottom:' . ($i < $updates->count() - 1 ? '1.25rem' : '0') . ';">';

                            // Timeline dot
                            $html .= '<div style="position:absolute; left:-1.5rem; top:0.375rem; width:0.9375rem; height:0.9375rem; border-radius:50%; background:' . $dotBg . '; border:2px solid ' . $dotColor . '; z-index:1;"></div>';

                            // Card
                            $html .= '<div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:0.625rem; padding:0.875rem 1rem; transition:border-color 0.15s;">';

                            // Header row
                            $html .= '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem;">';
                            $html .= '<div style="display:flex; align-items:center; gap:0.5rem;">';
                            // Avatar circle
                            $userName = e($update->user?->name ?? 'System');
                            $initials = collect(explode(' ', $userName))->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->take(2)->join('');
                            $html .= '<div style="width:1.625rem; height:1.625rem; border-radius:50%; background:linear-gradient(135deg, #4f46e5, #818cf8); display:flex; align-items:center; justify-content:center; flex-shrink:0;">';
                            $html .= '<span style="font-size:0.625rem; font-weight:700; color:#fff; line-height:1;">' . $initials . '</span>';
                            $html .= '</div>';
                            $html .= '<span style="font-size:0.8125rem; font-weight:600; color:#1e293b;">' . $userName . '</span>';
                            $html .= '</div>';
                            $html .= '<span style="font-size:0.6875rem; color:#94a3b8; white-space:nowrap;">' . $update->created_at->diffForHumans() . '</span>';
                            $html .= '</div>';

                            // Badges row
                            $hasBadges = $isStatusChange || $isTimeLog;
                            if ($hasBadges) {
                                $html .= '<div style="display:flex; flex-wrap:wrap; gap:0.375rem; margin-bottom:0.5rem;">';
                                if ($isStatusChange) {
                                    $statusLabel = ucfirst(str_replace('_', ' ', $update->status_change));
                                    $html .= '<span style="display:inline-flex; align-items:center; gap:0.25rem; padding:0.1875rem 0.5rem; font-size:0.6875rem; font-weight:600; color:#b45309; background:rgba(245,158,11,0.1); border:1px solid rgba(245,158,11,0.2); border-radius:1rem;">';
                                    $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>';
                                    $html .= e($statusLabel);
                                    $html .= '</span>';
                                }
                                if ($isTimeLog) {
                                    $html .= '<span style="display:inline-flex; align-items:center; gap:0.25rem; padding:0.1875rem 0.5rem; font-size:0.6875rem; font-weight:600; color:#059669; background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2); border-radius:1rem;">';
                                    $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>';
                                    $html .= $update->hours_logged . 'h logged';
                                    $html .= '</span>';
                                }
                                $html .= '</div>';
                            }

                            // Content
                            $html .= '<p style="font-size:0.8125rem; color:#475569; line-height:1.5; margin:0;">' . e($update->content) . '</p>';

                            // Media attachments
                            $recordings = $update->getMedia('recordings');
                            $attachments = $update->getMedia('attachments');

                            if ($recordings->isNotEmpty() || $attachments->isNotEmpty()) {
                                $html .= '<div style="display:flex; flex-wrap:wrap; gap:0.375rem; margin-top:0.625rem; padding-top:0.625rem; border-top:1px solid #f1f5f9;">';
                                foreach ($recordings as $media) {
                                    $html .= '<a href="' . $media->getUrl() . '" target="_blank" style="display:inline-flex; align-items:center; gap:0.25rem; padding:0.25rem 0.625rem; font-size:0.6875rem; font-weight:500; color:#6366f1; background:rgba(99,102,241,0.06); border:1px solid rgba(99,102,241,0.12); border-radius:0.375rem; text-decoration:none; transition:all 0.15s;">';
                                    $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>';
                                    $html .= e($media->file_name);
                                    $html .= '</a>';
                                }
                                foreach ($attachments as $media) {
                                    $html .= '<a href="' . $media->getUrl() . '" target="_blank" style="display:inline-flex; align-items:center; gap:0.25rem; padding:0.25rem 0.625rem; font-size:0.6875rem; font-weight:500; color:#6366f1; background:rgba(99,102,241,0.06); border:1px solid rgba(99,102,241,0.12); border-radius:0.375rem; text-decoration:none; transition:all 0.15s;">';
                                    $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"/></svg>';
                                    $html .= e($media->file_name);
                                    $html .= '</a>';
                                }
                                $html .= '</div>';
                            }

                            $html .= '</div>'; // card
                            $html .= '</div>'; // timeline entry
                        }

                        $html .= '</div>'; // timeline
                        $html .= '</div>'; // wrapper

                        return new HtmlString($html);
                    })
                    ->modalSubmitAction(false),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
