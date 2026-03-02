<?php

namespace App\Services;

use App\Models\Embedding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class RagService
{
    protected int $chunkSize = 800;

    protected int $chunkOverlap = 100;

    protected int $topK = 5;

    public function __construct(protected BedrockService $bedrock) {}

    /**
     * Chunk text into overlapping segments for embedding.
     *
     * @return array<string>
     */
    public function chunkText(string $text, ?int $chunkSize = null, ?int $overlap = null): array
    {
        $chunkSize = $chunkSize ?? $this->chunkSize;
        $overlap = $overlap ?? $this->chunkOverlap;

        $text = trim($text);

        if (mb_strlen($text) <= $chunkSize) {
            return [$text];
        }

        $paragraphs = preg_split('/\n{2,}/', $text);
        $chunks = [];
        $currentChunk = '';

        foreach ($paragraphs as $paragraph) {
            $paragraph = trim($paragraph);

            if (empty($paragraph)) {
                continue;
            }

            if (mb_strlen($currentChunk) + mb_strlen($paragraph) + 2 > $chunkSize && ! empty($currentChunk)) {
                $chunks[] = trim($currentChunk);
                $currentChunk = $overlap > 0
                    ? mb_substr($currentChunk, -$overlap) . "\n\n" . $paragraph
                    : $paragraph;
            } else {
                $currentChunk .= (empty($currentChunk) ? '' : "\n\n") . $paragraph;
            }

            if (mb_strlen($currentChunk) > $chunkSize) {
                $sentences = preg_split('/(?<=[.!?])\s+/', $currentChunk);
                $currentChunk = '';

                foreach ($sentences as $sentence) {
                    if (mb_strlen($currentChunk) + mb_strlen($sentence) + 1 > $chunkSize && ! empty($currentChunk)) {
                        $chunks[] = trim($currentChunk);
                        $currentChunk = $overlap > 0
                            ? mb_substr($currentChunk, -$overlap) . ' ' . $sentence
                            : $sentence;
                    } else {
                        $currentChunk .= (empty($currentChunk) ? '' : ' ') . $sentence;
                    }
                }
            }
        }

        if (! empty(trim($currentChunk))) {
            $chunks[] = trim($currentChunk);
        }

        return $chunks;
    }

    /**
     * Embed and store text chunks for a given model.
     * Uses content hashing to skip API calls for chunks already embedded elsewhere.
     */
    public function embedAndStore(Model $model, string $text, string $collection): void
    {
        $chunks = $this->chunkText($text);

        Embedding::forEmbeddable($model)
            ->forCollection($collection)
            ->delete();

        foreach ($chunks as $index => $chunk) {
            $hash = hash('sha256', $chunk);
            $existing = Embedding::where('content_hash', $hash)->first();

            $this->storeEmbedding($model, $chunk, $collection, $index, $hash, $existing?->embedding);
        }
    }

    /**
     * Retrieve the most relevant chunks for a query using cosine similarity.
     *
     * @return Collection<int, array{content: string, score: float, chunk_index: int}>
     */
    public function retrieve(string $query, string $collection, ?Model $scopeModel = null, ?int $topK = null): Collection
    {
        $topK = $topK ?? $this->topK;

        $queryEmbedding = $this->bedrock->generateEmbedding($query);

        $builder = Embedding::forCollection($collection);

        if ($scopeModel) {
            $builder->forEmbeddable($scopeModel);
        }

        $candidates = $builder->get();

        if ($candidates->isEmpty()) {
            return collect();
        }

        return $candidates
            ->map(fn (Embedding $embedding) => [
                'content' => $embedding->content,
                'score' => $this->cosineSimilarity($queryEmbedding, $embedding->embedding),
                'chunk_index' => $embedding->chunk_index,
            ])
            ->sortByDesc('score')
            ->take($topK)
            ->values();
    }

    /**
     * Retrieve relevant context as a single formatted string for prompt injection.
     */
    public function retrieveContext(string $query, string $collection, ?Model $scopeModel = null, ?int $topK = null): string
    {
        $chunks = $this->retrieve($query, $collection, $scopeModel, $topK);

        if ($chunks->isEmpty()) {
            return '';
        }

        return $chunks->map(fn ($chunk) => $chunk['content'])->implode("\n\n---\n\n");
    }

    /**
     * Check if embeddings exist for a model and collection.
     */
    public function hasEmbeddings(Model $model, string $collection): bool
    {
        return Embedding::forEmbeddable($model)
            ->forCollection($collection)
            ->exists();
    }

    /**
     * Estimate token count for a string (rough approximation: ~4 chars per token).
     */
    public function estimateTokens(string $text): int
    {
        return (int) ceil(mb_strlen($text) / 4);
    }

    /**
     * Build an optimized message array from conversation history.
     * Keeps recent messages intact and summarizes older ones to stay within token budget.
     */
    public function optimizeMessages(array $messages, int $maxTokenBudget = 3000, int $keepRecent = 4): array
    {
        if (count($messages) <= $keepRecent) {
            return $messages;
        }

        $totalTokens = array_sum(array_map(fn ($msg) => $this->estimateTokens($msg['content']), $messages));

        if ($totalTokens <= $maxTokenBudget) {
            return $messages;
        }

        $older = array_slice($messages, 0, -$keepRecent);
        $recent = array_slice($messages, -$keepRecent);
        $summary = $this->bedrock->summarizeConversation($older);

        return [
            ['role' => 'user', 'content' => "[Previous conversation summary]\n{$summary}"],
            ['role' => 'assistant', 'content' => 'Understood. I have the context from our previous discussion. How can I help?'],
            ...$recent,
        ];
    }

    /**
     * Compute cosine similarity between two vectors.
     */
    protected function cosineSimilarity(array $a, array $b): float
    {
        if (count($a) !== count($b) || empty($a)) {
            return 0.0;
        }

        $dotProduct = 0.0;
        $normA = 0.0;
        $normB = 0.0;
        $length = count($a);

        for ($i = 0; $i < $length; $i++) {
            $dotProduct += $a[$i] * $b[$i];
            $normA += $a[$i] * $a[$i];
            $normB += $b[$i] * $b[$i];
        }

        $denominator = sqrt($normA) * sqrt($normB);

        return $denominator === 0.0 ? 0.0 : $dotProduct / $denominator;
    }

    /**
     * Persist a single embedding record, reusing a pre-computed vector when available.
     */
    protected function storeEmbedding(Model $model, string $chunk, string $collection, int $index, string $hash, ?array $existingVector): void
    {
        Embedding::create([
            'embeddable_type' => $model->getMorphClass(),
            'embeddable_id' => $model->getKey(),
            'content' => $chunk,
            'embedding' => $existingVector ?? $this->bedrock->generateEmbedding($chunk),
            'collection' => $collection,
            'chunk_index' => $index,
            'content_hash' => $hash,
        ]);
    }
}
