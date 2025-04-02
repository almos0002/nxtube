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
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->text('robots_txt')->nullable();
            $table->text('sitemap_settings')->nullable();
            $table->string('google_verification')->nullable();
            $table->string('bing_verification')->nullable();
            $table->string('yandex_verification')->nullable();
            $table->string('baidu_verification')->nullable();
            $table->string('pinterest_verification')->nullable();
            $table->text('custom_meta_tags')->nullable();
            $table->text('structured_data')->nullable();
            $table->boolean('auto_generate_sitemap')->default(true);
            $table->string('sitemap_frequency')->default('weekly');
            $table->string('sitemap_priority')->default('0.8');
            $table->boolean('noindex_pagination')->default(true);
            $table->boolean('enable_social_meta')->default(true);
            $table->boolean('enable_canonical_urls')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
