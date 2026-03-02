<?php

namespace App\Services;

use Aws\BedrockRuntime\BedrockRuntimeClient;

class BedrockService
{
    protected BedrockRuntimeClient $client;

    protected string $model;

    protected string $embedModel;

    public function __construct()
    {
        $this->client = new BedrockRuntimeClient([
            'region' => config('services.bedrock.region'),
            'version' => 'latest',
            'credentials' => [
                'key' => config('services.bedrock.key'),
                'secret' => config('services.bedrock.secret'),
            ],
        ]);

        $this->model = config('services.bedrock.model');
        $this->embedModel = config('services.bedrock.embed_model', 'amazon.titan-embed-text-v2:0');
    }

    /**
     * Generate a vector embedding for the given text using Amazon Titan Text Embeddings.
     *
     * @return array<float> The embedding vector (1024 dimensions for Titan v2)
     */
    public function generateEmbedding(string $text): array
    {
        $cacheKey = 'embed:' . hash('sha256', $text);

        return cache()->remember($cacheKey, now()->addDays(7), function () use ($text) {
            $response = $this->client->invokeModel([
                'modelId' => $this->embedModel,
                'contentType' => 'application/json',
                'accept' => 'application/json',
                'body' => json_encode([
                    'inputText' => $text,
                    'dimensions' => 512,
                    'normalize' => true,
                ]),
            ]);

            $body = json_decode($response['body']->getContents(), true);

            return $body['embedding'] ?? [];
        });
    }

    /**
     * Generate embeddings for multiple texts in batch.
     *
     * @param  array<string>  $texts
     * @return array<array<float>>
     */
    public function generateEmbeddings(array $texts): array
    {
        return array_map(fn (string $text) => $this->generateEmbedding($text), $texts);
    }

    /**
     * Summarize a long conversation history into a concise context.
     * Used for token optimization when chat history grows too long.
     */
    public function summarizeConversation(array $messages): string
    {
        $systemPrompt = 'You are a concise summarizer. Summarize the following conversation into key points, decisions made, and important context. Keep it under 500 words. Preserve technical details and specific requirements.';

        $conversationText = collect($messages)
            ->map(fn ($msg) => ($msg['role'] === 'user' ? 'User' : 'AI') . ": {$msg['content']}")
            ->implode("\n\n");

        return $this->chat($systemPrompt, [
            ['role' => 'user', 'content' => "Summarize this conversation:\n\n{$conversationText}"],
        ]);
    }

    public function chat(string $systemPrompt, array $messages): string
    {
        $response = $this->client->invokeModel([
            'modelId' => $this->model,
            'contentType' => 'application/json',
            'accept' => 'application/json',
            'body' => json_encode([
                'anthropic_version' => 'bedrock-2023-05-31',
                'max_tokens' => 4096,
                'system' => $systemPrompt,
                'messages' => $messages,
            ]),
        ]);

        $body = json_decode($response['body']->getContents(), true);

        return $body['content'][0]['text'] ?? '';
    }

    public function brainstorm(string $topic, string $context = '', array $documentSummaries = [], ?float $budget = null, ?string $projectType = null): string
    {
        $systemPrompt = <<<'PROMPT'
You are a senior product strategist, market research analyst, and technical architect. When given a product idea or topic, provide comprehensive market research and brainstorming analysis including:

1. **Market Overview** — Current market size, trends, and growth potential
2. **Competitor Analysis** — Key competitors, their strengths/weaknesses, pricing
3. **Target Audience** — Demographics, psychographics, pain points
4. **Unique Value Proposition** — What makes this idea stand out
5. **Monetization Strategies** — Revenue models, pricing strategies
6. **Recommended Tech Stack** — Based on budget, project type, and requirements:
   - For each recommendation explain WHY it fits the budget
   - Include cost breakdown (hosting, licenses, third-party services)
   - Suggest free/open-source alternatives where budget is tight
   - Consider both development cost and ongoing operational cost
7. **Risks & Challenges** — Potential obstacles and mitigation strategies
8. **Opportunities** — Market gaps, partnership possibilities, expansion paths
9. **Go-to-Market Strategy** — Launch approach, marketing channels
10. **MVP Recommendations** — Core features for initial launch
11. **AI Integration Points** — Where AI can be plugged in to add value:
   - Customer support (chatbots, auto-responses)
   - Content generation & personalization
   - Data analysis & insights
   - Automation opportunities
   - Recommendation engines
   - Predictive analytics

Be specific, data-informed, and actionable. Use real-world examples where relevant. When suggesting tech stacks, always justify the choice based on the available budget and project type.
PROMPT;

        $userContent = "Topic: {$topic}";

        if ($context) {
            $userContent .= "\n\nAdditional Context: {$context}";
        }

        if ($budget) {
            $userContent .= "\n\nAvailable Budget: \${$budget}";
            $userContent .= "\nIMPORTANT: Recommend tech stacks that fit within this budget. Break down development vs. operational costs.";
        }

        if ($projectType) {
            $userContent .= "\n\nProject Type: {$projectType}";
        }

        if (! empty($documentSummaries)) {
            $summaryLines = collect($documentSummaries)
                ->map(fn ($doc) => "- {$doc['name']}: {$doc['summary']}")
                ->implode("\n");

            $userContent .= "\n\nUploaded Reference Documents:\n{$summaryLines}";
        }

        return $this->chat($systemPrompt, [
            ['role' => 'user', 'content' => $userContent],
        ]);
    }

    public function generateSpec(string $brainstormContent, string $projectContext = ''): string
    {
        $systemPrompt = <<<'PROMPT'
You are a senior software architect who creates detailed system specifications optimized for AI-assisted development (vibe coding). Generate a comprehensive, structured specification in Markdown format.

The spec MUST follow this exact structure:

# [Project Name] — System Specification

## Overview
[One-paragraph summary of the project]

## User Personas
- **Persona 1**: [description, goals, pain points]
(repeat for each persona)

## Features & User Stories
### Feature 1: [Name]
- As a [persona], I want to [action] so that [benefit]
- Acceptance Criteria: [specific, testable criteria]
(repeat for each feature)

## Data Models
### ModelName
| Field | Type | Notes |
|-------|------|-------|
| field_name | type | constraints/notes |

### Relationships
- ModelA hasMany ModelB
- ModelB belongsTo ModelA
(list all relationships)

## API Endpoints
| Method | Path | Description | Auth |
|--------|------|-------------|------|
| GET | /api/resource | List all | Yes |
(list all endpoints)

## Tech Stack
- Backend: [recommendation with justification]
- Frontend: [recommendation with justification]
- Database: [recommendation]
- Hosting: [recommendation]
- Key Libraries: [list with purposes]

## MVP Scope
### Phase 1 (MVP)
- [ ] Feature A
- [ ] Feature B

### Phase 2 (Post-MVP)
- [ ] Feature C
- [ ] Feature D

### Phase 3 (Future)
- [ ] Feature E

## Acceptance Criteria
[Overall project acceptance criteria]

Be thorough, specific, and ensure every feature has clear acceptance criteria. Data models should include all fields with types. The spec should be directly usable by an AI coding assistant to build the project.
PROMPT;

        $userContent = "Based on the following brainstorm, generate a complete system specification:\n\n{$brainstormContent}";

        if ($projectContext) {
            $userContent .= "\n\nProject Context: {$projectContext}";
        }

        return $this->chat($systemPrompt, [
            ['role' => 'user', 'content' => $userContent],
        ]);
    }

    public function continueChat(array $messages, string $systemPrompt = 'You are a helpful product strategist and software architect assistant. Continue the conversation naturally, providing detailed and actionable insights. When asked to refine or expand on previous points, be specific and thorough.'): string
    {
        return $this->chat($systemPrompt, $messages);
    }

    /**
     * Break a spec into structured tasks with milestones, assignments, and time estimates.
     * Returns JSON array of milestones with nested tasks.
     */
    public function generateTasks(string $specContent, array $teamMembers = []): string
    {
        $systemPrompt = <<<'PROMPT'
You are a senior project manager who breaks down system specifications into actionable milestones and tasks. You MUST respond with valid JSON only — no markdown, no explanations, just the JSON array.

Structure:
```json
[
  {
    "milestone": "Milestone Title",
    "description": "Brief description",
    "tasks": [
      {
        "title": "Task title",
        "description": "Detailed task description with acceptance criteria",
        "priority": "low|medium|high|urgent",
        "estimated_hours": 4.0,
        "suggested_role": "developer|designer|project_manager|admin",
        "suggested_assignee": "Name or null"
      }
    ]
  }
]
```

Rules:
- Break features into small, manageable tasks (2-8 hours each)
- Group related tasks under milestones
- Order milestones by dependency (what must be built first)
- Include setup/config tasks, feature tasks, testing tasks, and deployment tasks
- Be specific in task descriptions — include technical details
- Assign realistic hour estimates
- If team members are provided, suggest assignments based on their roles
- Each task description should include clear acceptance criteria
PROMPT;

        $userContent = "Break this specification into milestones and tasks:\n\n{$specContent}";

        if (! empty($teamMembers)) {
            $teamLines = collect($teamMembers)
                ->map(fn ($member) => "- {$member['name']} ({$member['role']})")
                ->implode("\n");

            $userContent .= "\n\nAvailable team members and their roles:\n{$teamLines}";
        }

        return $this->chat($systemPrompt, [
            ['role' => 'user', 'content' => $userContent],
        ]);
    }

    /**
     * Generate a weekly retrospective for a project based on its activity.
     */
    public function generateWeeklyRetro(array $projectData): string
    {
        $systemPrompt = <<<'PROMPT'
You are a project manager writing a professional weekly retrospective. Based on the project data provided, write a concise but insightful retrospective that covers:

1. **Summary** — What happened this week in 2-3 sentences
2. **Milestones Achieved** — What was completed (celebrate wins)
3. **Tasks Progress** — Overview of task completion rate and time tracking
4. **Blockers & Challenges** — Any issues or delays
5. **Team Performance** — Who contributed what (be positive and constructive)
6. **Next Week Focus** — What's coming up and priorities
7. **Risks** — Any concerns about timeline, budget, or scope

Write in a professional but friendly tone. Use specific numbers and names from the data.
Be concise — this should be readable in 2-3 minutes.
PROMPT;

        $userContent = json_encode($projectData, JSON_PRETTY_PRINT);

        return $this->chat($systemPrompt, [
            ['role' => 'user', 'content' => "Generate a weekly retro for this project data:\n\n{$userContent}"],
        ]);
    }
}
