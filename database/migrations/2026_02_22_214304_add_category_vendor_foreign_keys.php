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
        Schema::table('category_vendor', function (Blueprint $table) {
            // Add category_id column
            $table->foreignId('category_id')
                  ->after('id')
                  ->constrained('categories')
                  ->onDelete('cascade');
            
            // Add user_id column (for vendors)
            $table->foreignId('user_id')
                  ->after('category_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            // Add unique constraint to prevent duplicate relationships
            $table->unique(['category_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_vendor', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['category_id']);
            $table->dropForeign(['user_id']);
            
            // Drop unique constraint
            $table->dropUnique(['category_id', 'user_id']);
            
            // Drop the columns
            $table->dropColumn(['category_id', 'user_id']);
        });
    }
};