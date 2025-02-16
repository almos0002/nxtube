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
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                // Site Configuration
                $table->string('site_name')->default('VideoFlex');
                $table->text('site_description')->nullable();
                $table->string('contact_email')->nullable();
                $table->string('support_phone')->nullable();
                
                // CDN Configuration
                $table->string('cdn_provider')->default('Cloudflare');
                $table->string('cdn_url')->nullable();
                $table->text('cdn_api_key')->nullable();
                
                // Cache Settings
                $table->boolean('cache_enabled')->default(true);
                $table->integer('cache_duration')->default(60); // in minutes
                $table->boolean('cache_static_assets')->default(true);
                $table->boolean('cache_api_responses')->default(true);
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
