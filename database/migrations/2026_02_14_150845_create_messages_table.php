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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->string('subject')->nullable();
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('messages')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); // Adds deleted_at column for soft deletes
            
            // Indexes for better performance
            $table->index(['receiver_id', 'is_read']);
            $table->index('created_at');
            $table->index('deleted_at');
            
            // Composite indexes for common queries
            $table->index(['sender_id', 'receiver_id', 'deleted_at']);
            $table->index(['parent_id', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};