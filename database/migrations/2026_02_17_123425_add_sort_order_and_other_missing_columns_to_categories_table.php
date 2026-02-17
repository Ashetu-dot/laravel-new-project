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
            // Add sort_order column for ordering categories
            if (!Schema::hasColumn('categories', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('is_active');
            }
            
            // Add short_description column if it doesn't exist
            if (!Schema::hasColumn('categories', 'short_description')) {
                $table->string('short_description')->nullable()->after('description');
            }
            
            // Add icon column if it doesn't exist
            if (!Schema::hasColumn('categories', 'icon')) {
                $table->string('icon')->nullable()->after('slug');
            }
            
            // Add image column if it doesn't exist
            if (!Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable()->after('icon');
            }
            
            // Add parent_id column if it doesn't exist (for subcategories)
            if (!Schema::hasColumn('categories', 'parent_id')) {
                $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade')->after('is_active');
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
            $columns = ['sort_order', 'short_description', 'icon', 'image', 'parent_id', 'vendor_id'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('categories', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};