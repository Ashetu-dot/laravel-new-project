<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Check and add slug column
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('name');
            }
            
            // Check and add tags column (JSON)
            if (!Schema::hasColumn('products', 'tags')) {
                $table->json('tags')->nullable()->after('images');
            }
            
            // Check and add meta_title
            if (!Schema::hasColumn('products', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('tags');
            }
            
            // Check and add meta_description
            if (!Schema::hasColumn('products', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            
            // Check and add views_count
            if (!Schema::hasColumn('products', 'views_count')) {
                $table->integer('views_count')->default(0)->after('rating');
            }
            
            // Also check for other common missing columns
            if (!Schema::hasColumn('products', 'sold_count')) {
                $table->integer('sold_count')->default(0)->after('stock');
            }
            
            if (!Schema::hasColumn('products', 'rating')) {
                $table->decimal('rating', 3, 2)->default(0)->after('sold_count');
            }
            
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku')->unique()->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $columns = [
                'slug', 
                'tags', 
                'meta_title', 
                'meta_description', 
                'views_count',
                'sold_count',
                'rating',
                'sku'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};