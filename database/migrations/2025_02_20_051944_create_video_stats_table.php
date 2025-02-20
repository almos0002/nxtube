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
        Schema::create('video_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->constrained()->onDelete('cascade');
            $table->bigInteger('views_count')->default(0);
            $table->timestamps();

            // Add index for faster lookups
            $table->index('video_id');
        });

        Schema::create('recent_video_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->constrained()->onDelete('cascade');
            $table->string('ip_address');
            $table->timestamp('viewed_at');
            
            // Index for faster lookups and cleanup
            $table->index(['ip_address', 'video_id', 'viewed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recent_video_views');
        Schema::dropIfExists('video_stats');
    }
};
