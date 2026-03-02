<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('embeddings', function (Blueprint $table) {
            $table->id();
            $table->morphs('embeddable');
            $table->text('content');
            $table->json('embedding');
            $table->string('collection')->index();
            $table->unsignedInteger('chunk_index')->default(0);
            $table->string('content_hash', 64)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embeddings');
    }
};
