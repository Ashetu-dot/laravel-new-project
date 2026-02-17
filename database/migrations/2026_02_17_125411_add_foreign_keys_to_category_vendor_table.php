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
            if (!Schema::hasColumn('category_vendor', 'category_id')) {
                $table->foreignId('category_id')->constrained()->onDelete('cascade')->after('id');
            }
            
            // Add user_id column (for vendor)
            if (!Schema::hasColumn('category_vendor', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('category_id');
            }
            
            // Add unique constraint to prevent duplicates
            $table->unique(['category_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_vendor', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['category_id', 'user_id']);
            $table->dropUnique(['category_id', 'user_id']);
        });
    }
};