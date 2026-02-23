<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_recently_viewed_table.php

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
        Schema::create('recently_viewed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->integer('view_count')->default(1);
            $table->timestamps();
            
            // Prevent duplicate entries
            $table->unique(['user_id', 'vendor_id']);
            
            // Indexes
            $table->index(['user_id', 'created_at']);
            $table->index('view_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recently_viewed');
    }
};