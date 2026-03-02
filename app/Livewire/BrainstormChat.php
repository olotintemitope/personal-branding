<?php

namespace App\Livewire;

use App\Enums\BrainstormStatus;
use App\Enums\TaskPriority;
use App\Models\Brainstorm;
use App\Models\Project;
use App\Models\Task;
use App\Services\BedrockService;
use App\Services\RagService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Livewire\Component;
use Livewire\WithFileUploads;

class BrainstormChat extends Component
{
    use WithFileUploads;

    public ?Brainstorm $brainstorm = null;

    public string $title = '';

    public string $topic = '';

    public ?int $projectId = null;

    public string $userMessage = '';

    public bool $isLoading = false;

    public array $uploads = [];

    public bool $useProjectDocs = false;

    public string $activeTab = 'new';

    protected BedrockService $bedrock;

    protected RagService $rag;

    public function boot(BedrockService $bedrock, RagService $rag): void
    {
        $this->bedrock = $bedrock;
        $this->rag = $rag;
    }

    public function startBrainstorm(): void
    {
        $this->validate([
            'title' => 'required|min:3',
            'topic' => 'required|min:10',
            'uploads.*' => 'nullable|file|max:10240',
        ]);

        $this->isLoading = true;

        $this->brainstorm = Brainstorm::create([
            'user_id' => auth()->id(),
            'project_id' => $this->projectId,
            'title' => $this->title,
            'topic' => $this->topic,
            'status' => BrainstormStatus::Brainstorming,
            'messages' => [],
        ]);

        [$documentSummaries, $documentTexts] = $this->processUploadedFiles();

        $budget = null;
        $projectType = null;

        if ($this->projectId && $this->useProjectDocs) {
            $project = Project::with('documents')->find($this->projectId);

            if ($project) {
                $budget = (float) $project->budget;
                $projectType = $project->project_type?->getLabel();

                foreach ($project->documents as $doc) {
                    foreach ($doc->getMedia('*') as $media) {
                        $documentSummaries[] = [
                            'name' => $media->name,
                            'summary' => "Project document: {$media->name} ({$media->mime_type}, " . round($media->size / 1024) . 'KB)',
                        ];
                    }
                }
            }
        }

        try {
            $response = $this->bedrock->brainstorm($this->topic, '', $documentSummaries, $budget, $projectType);

            $messages = [
                ['role' => 'user', 'content' => "Topic: {$this->topic}"],
                ['role' => 'assistant', 'content' => $response],
            ];

            $this->brainstorm->update([
                'brainstorm_content' => $response,
                'messages' => $messages,
            ]);

            $this->embedBrainstormContent($response, $documentTexts);
        } catch (\Exception $e) {
            $this->brainstorm->update([
                'messages' => [
                    ['role' => 'user', 'content' => "Topic: {$this->topic}"],
                    ['role' => 'assistant', 'content' => 'Error: Unable to connect to AI service. Please check your AWS Bedrock credentials and try again. Error: ' . $e->getMessage()],
                ],
            ]);
        }

        $this->uploads = [];
        $this->isLoading = false;
        $this->activeTab = 'chat';
    }

    public function sendMessage(): void
    {
        if (! $this->brainstorm || ! trim($this->userMessage)) {
            return;
        }

        $this->isLoading = true;

        $messages = $this->brainstorm->messages ?? [];
        $messages[] = ['role' => 'user', 'content' => $this->userMessage];

        $this->brainstorm->update(['messages' => $messages]);

        $userQuery = $this->userMessage;
        $this->userMessage = '';

        try {
            $ragContext = $this->rag->retrieveContext($userQuery, 'brainstorm', $this->brainstorm, topK: 5);
            $optimizedMessages = $this->rag->optimizeMessages($messages, maxTokenBudget: 3000, keepRecent: 4);

            $systemPrompt = 'You are a helpful product strategist and software architect assistant. Continue the conversation naturally, providing detailed and actionable insights. When asked to refine or expand on previous points, be specific and thorough.';

            if ($ragContext) {
                $systemPrompt .= "\n\nRelevant context from previous analysis:\n{$ragContext}";
            }

            $response = $this->bedrock->continueChat($optimizedMessages, $systemPrompt);

            $messages[] = ['role' => 'assistant', 'content' => $response];

            $this->brainstorm->update([
                'messages' => $messages,
                'brainstorm_content' => $this->brainstorm->brainstorm_content . "\n\n---\n\n" . $response,
            ]);

            $this->embedBrainstormContent($this->brainstorm->brainstorm_content);
        } catch (\Exception $e) {
            $messages[] = ['role' => 'assistant', 'content' => 'Error: ' . $e->getMessage()];
            $this->brainstorm->update(['messages' => $messages]);
        }

        $this->isLoading = false;
    }

    public function generateSpec(): void
    {
        if (! $this->brainstorm || ! $this->brainstorm->brainstorm_content) {
            return;
        }

        $this->isLoading = true;

        try {
            $projectContext = $this->buildProjectContext();

            $relevantContent = $this->rag->retrieveContext(
                "Generate a system specification for: {$this->brainstorm->topic}",
                'brainstorm',
                $this->brainstorm,
                topK: 10
            );

            $spec = $this->bedrock->generateSpec(
                $relevantContent ?: $this->brainstorm->brainstorm_content,
                $projectContext
            );

            $this->brainstorm->update([
                'spec_content' => $spec,
                'status' => BrainstormStatus::SpecGenerated,
            ]);

            $this->rag->embedAndStore($this->brainstorm, $spec, 'spec');

            $this->activeTab = 'spec';
        } catch (\Exception $e) {
            $this->brainstorm->update([
                'spec_content' => 'Error generating spec: ' . $e->getMessage(),
            ]);
        }

        $this->isLoading = false;
    }

    public function downloadPdf(): Response
    {
        abort_unless($this->brainstorm?->spec_content, 404);

        $pdf = Pdf::loadView('pdf.spec', [
            'brainstorm' => $this->brainstorm,
            'spec' => $this->brainstorm->spec_content,
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            "spec-{$this->brainstorm->id}.pdf"
        );
    }

    public function downloadMarkdown(): Response
    {
        abort_unless($this->brainstorm?->spec_content, 404);

        $filename = str($this->brainstorm->title)->slug() . '-spec.md';

        return response()->streamDownload(
            fn () => print($this->brainstorm->spec_content),
            $filename,
            ['Content-Type' => 'text/markdown']
        );
    }

    public function loadBrainstorm(int $id): void
    {
        $this->brainstorm = Brainstorm::where('user_id', auth()->id())->findOrFail($id);
        $this->title = $this->brainstorm->title;
        $this->topic = $this->brainstorm->topic;
        $this->projectId = $this->brainstorm->project_id;
        $this->activeTab = $this->brainstorm->spec_content ? 'spec' : 'chat';
    }

    public function generateTasks(): void
    {
        if (! $this->brainstorm?->spec_content || ! $this->brainstorm->project_id) {
            return;
        }

        $this->isLoading = true;

        try {
            $project = $this->brainstorm->project;

            $teamMembers = $project->teamMembers->map(fn ($u) => [
                'name' => $u->name,
                'role' => $u->pivot->role ?? 'team member',
            ])->toArray();

            $relevantSpec = $this->rag->retrieveContext(
                'Break down all features, data models, API endpoints, and MVP phases into tasks',
                'spec',
                $this->brainstorm,
                topK: 10
            );

            $tasksJson = $this->bedrock->generateTasks($relevantSpec ?: $this->brainstorm->spec_content, $teamMembers);
            $tasksJson = preg_replace('/^```json\s*|\s*```$/m', '', trim($tasksJson));
            $milestones = json_decode($tasksJson, true);

            if (! is_array($milestones)) {
                throw new \Exception('AI returned invalid task structure.');
            }

            $sortOrder = $project->milestones()->max('sort_order') ?? 0;

            foreach ($milestones as $milestoneData) {
                $milestone = $project->milestones()->create([
                    'title' => $milestoneData['milestone'],
                    'description' => $milestoneData['description'] ?? null,
                    'sort_order' => ++$sortOrder,
                ]);

                $taskSort = 0;
                foreach ($milestoneData['tasks'] ?? [] as $taskData) {
                    $assignedTo = null;

                    if (! empty($taskData['suggested_assignee'])) {
                        $assignedTo = $project->teamMembers()
                            ->where('users.name', 'like', "%{$taskData['suggested_assignee']}%")
                            ->first()
                            ?->id;
                    }

                    Task::create([
                        'project_id' => $project->id,
                        'milestone_id' => $milestone->id,
                        'assigned_to' => $assignedTo,
                        'created_by' => auth()->id(),
                        'title' => $taskData['title'],
                        'description' => $taskData['description'] ?? null,
                        'priority' => TaskPriority::tryFrom($taskData['priority'] ?? 'medium') ?? TaskPriority::Medium,
                        'estimated_hours' => $taskData['estimated_hours'] ?? null,
                        'sort_order' => ++$taskSort,
                    ]);
                }
            }

            $taskCount = collect($milestones)->sum(fn ($m) => count($m['tasks'] ?? []));
            $milestoneCount = count($milestones);

            $messages = $this->brainstorm->messages ?? [];
            $messages[] = ['role' => 'assistant', 'content' => "I've created {$taskCount} tasks across {$milestoneCount} milestones on project **{$project->title}**. You can view and manage them from the project page."];

            $this->brainstorm->update([
                'status' => BrainstormStatus::Completed,
                'messages' => $messages,
            ]);
        } catch (\Exception $e) {
            $messages = $this->brainstorm->messages ?? [];
            $messages[] = ['role' => 'assistant', 'content' => 'Error generating tasks: ' . $e->getMessage()];
            $this->brainstorm->update(['messages' => $messages]);
        }

        $this->isLoading = false;
    }

    public function newBrainstorm(): void
    {
        $this->brainstorm = null;
        $this->title = '';
        $this->topic = '';
        $this->projectId = null;
        $this->userMessage = '';
        $this->uploads = [];
        $this->useProjectDocs = false;
        $this->activeTab = 'new';
    }

    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function render(): \Illuminate\View\View
    {
        $savedBrainstorms = Brainstorm::where('user_id', auth()->id())
            ->latest()
            ->limit(20)
            ->get();

        $projects = Project::orderBy('title')->get(['id', 'title', 'budget', 'project_type', 'currency']);

        return view('livewire.brainstorm-chat', [
            'savedBrainstorms' => $savedBrainstorms,
            'projects' => $projects,
        ]);
    }

    /**
     * Process uploaded files, store media, and extract embeddable text.
     *
     * @return array{0: array<array{name: string, summary: string}>, 1: array<string>}
     */
    protected function processUploadedFiles(): array
    {
        $documentSummaries = [];
        $documentTexts = [];
        $embeddableTypes = ['text/plain', 'text/markdown', 'text/csv'];

        foreach ($this->uploads as $file) {
            $this->brainstorm
                ->addMedia($file->getRealPath())
                ->usingName($file->getClientOriginalName())
                ->usingFileName($file->getClientOriginalName())
                ->toMediaCollection('documents');

            $fileName = $file->getClientOriginalName();

            $documentSummaries[] = [
                'name' => $fileName,
                'summary' => "Uploaded file: {$fileName} ({$file->getClientMimeType()}, " . round($file->getSize() / 1024) . 'KB)',
            ];

            if (in_array($file->getClientMimeType(), $embeddableTypes)) {
                $content = file_get_contents($file->getRealPath());

                if ($content) {
                    $documentTexts[] = "Document: {$fileName}\n\n{$content}";
                }
            }
        }

        return [$documentSummaries, $documentTexts];
    }

    /**
     * Embed brainstorm content and any extracted document texts into the RAG store.
     * Failures are logged as warnings and do not interrupt the brainstorm flow.
     */
    protected function embedBrainstormContent(string $brainstormResponse, array $documentTexts = []): void
    {
        try {
            $parts = ["Topic: {$this->topic}\n\n{$brainstormResponse}"];

            foreach ($documentTexts as $docText) {
                $parts[] = $docText;
            }

            $this->rag->embedAndStore($this->brainstorm, implode("\n\n---\n\n", $parts), 'brainstorm');
        } catch (\Exception $e) {
            logger()->warning('RAG embedding failed', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Build a project context string for spec and task generation.
     */
    protected function buildProjectContext(): string
    {
        if (! $this->brainstorm->project) {
            return '';
        }

        $project = $this->brainstorm->project;
        $context = "Project: {$project->title}";

        if ($project->budget) {
            $context .= ", Budget: {$project->currency?->format($project->budget)}";
        }

        if ($project->project_type) {
            $context .= ", Type: {$project->project_type->getLabel()}";
        }

        return $context;
    }
}
