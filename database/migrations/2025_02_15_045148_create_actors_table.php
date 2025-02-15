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
        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->string('profile_image')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('stagename')->nullable();
            $table->text('biography')->nullable();
            $table->string('banner_image')->nullable();
            $table->enum('type', ['actor', 'actress']);
            $table->date('dob');
            $table->string('language');
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('website')->nullable();
            $table->enum('visibility', ['public', 'draft']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actors');
    }
};
