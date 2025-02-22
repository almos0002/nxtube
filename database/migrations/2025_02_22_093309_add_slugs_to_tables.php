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
        Schema::table('videos', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title');
        });

        Schema::table('actors', function (Blueprint $table) {
            $table->string('slug')->unique()->after('stagename');
        });

        Schema::table('channels', function (Blueprint $table) {
            $table->string('slug')->unique()->after('channel_name');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('actors', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('channels', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
