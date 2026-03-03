<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_tutorials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('youtube_id')->nullable(); // YouTube video ID
            $table->string('vimeo_id')->nullable(); // Vimeo video ID
            $table->string('thumbnail')->nullable();
            $table->integer('duration')->nullable(); // Duration in seconds
            $table->string('category')->default('general');
            $table->json('tags')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('views_count')->default(0);
            $table->timestamps();
            
            $table->index('category');
            $table->index('is_featured');
            $table->index('is_published');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_tutorials');
    }
};