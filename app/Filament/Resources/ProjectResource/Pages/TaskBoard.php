<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\Project;
use Filament\Resources\Pages\Page;

class TaskBoard extends Page
{
    protected static string $resource = ProjectResource::class;

    protected string $view = 'filament.resources.project-resource.pages.task-board';

    public Project $record;

    public function getTitle(): string
    {
        return "Task Board — {$this->record->title}";
    }

    public function getBreadcrumbs(): array
    {
        return [
            route('filament.admin.resources.projects.index') => 'Projects',
            route('filament.admin.resources.projects.edit', $this->record) => $this->record->title,
            '' => 'Task Board',
        ];
    }
}
