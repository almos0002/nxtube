<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video_link');
            $table->string('duration');
            $table->text('description')->nullable();
            $table->string('thumbnail');
            $table->foreignId('channel_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('language');
            $table->foreignId('actor_id')->constrained();
            $table->enum('visibility', ['public', 'draft']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
