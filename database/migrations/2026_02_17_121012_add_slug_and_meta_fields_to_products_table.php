<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add slug field
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('name');
            }
            
            // Add meta fields
            if (!Schema::hasColumn('products', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('tags');
            }
            
            if (!Schema::hasColumn('products', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            
            // Add views count
            if (!Schema::hasColumn('products', 'views_count')) {
                $table->integer('views_count')->default(0)->after('rating');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $columns = ['slug', 'meta_title', 'meta_description', 'views_count'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};