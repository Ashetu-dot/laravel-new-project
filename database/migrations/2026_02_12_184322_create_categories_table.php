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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('icon')->nullable()->comment('Icon class for the category');
            $table->string('image')->nullable()->comment('Path to category image');
            $table->string('image_color')->nullable()->comment('Fallback color for image placeholder');
            $table->boolean('is_global')->default(true)->comment('If true, category is available to all vendors');
            $table->boolean('is_active')->default(true);
            $table->foreignId('vendor_id')->nullable()->constrained('users')->onDelete('cascade')->comment('If not global, belongs to specific vendor');
            $table->integer('sort_order')->default(0)->comment('Order for displaying categories');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();

            // Add indexes for better performance
            $table->index(['is_active', 'is_global']);
            $table->index('parent_id');
            $table->index('vendor_id');
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
