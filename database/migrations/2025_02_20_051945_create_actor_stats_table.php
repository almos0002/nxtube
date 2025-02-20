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
        Schema::create('actor_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actor_id')->constrained()->onDelete('cascade');
            $table->bigInteger('views_count')->default(0);
            $table->timestamps();

            // Add index for faster lookups
            $table->index('actor_id');
        });

        Schema::create('recent_actor_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actor_id')->constrained()->onDelete('cascade');
            $table->string('ip_address');
            $table->timestamp('viewed_at');
            
            // Index for faster lookups and cleanup
            $table->index(['ip_address', 'actor_id', 'viewed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recent_actor_views');
        Schema::dropIfExists('actor_stats');
    }
};
