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
        Schema::table('categories', function (Blueprint $table) {
            // Add icon column if it doesn't exist
            if (!Schema::hasColumn('categories', 'icon')) {
                $table->string('icon')->nullable()->after('slug');
            }
            
            // Add short_description column if it doesn't exist
            if (!Schema::hasColumn('categories', 'short_description')) {
                $table->string('short_description')->nullable()->after('description');
            }
            
            // Add parent_id column if it doesn't exist (for subcategories)
            if (!Schema::hasColumn('categories', 'parent_id')) {
                $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade')->after('is_active');
            }
            
            // Add image column if it doesn't exist
            if (!Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable()->after('icon');
            }
            
            // Add vendor_id column if it doesn't exist
            if (!Schema::hasColumn('categories', 'vendor_id')) {
                $table->foreignId('vendor_id')->nullable()->constrained('users')->onDelete('cascade')->after('parent_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $columns = ['icon', 'short_description', 'parent_id', 'image', 'vendor_id'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('categories', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};