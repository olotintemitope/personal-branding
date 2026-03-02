<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brainstorms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('topic');
            $table->longText('brainstorm_content')->nullable();
            $table->longText('spec_content')->nullable();
            $table->json('messages')->nullable();
            $table->string('status')->default('brainstorming');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brainstorms');
    }
};
