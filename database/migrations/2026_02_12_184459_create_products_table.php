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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // Pricing
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            
            // Inventory
            $table->integer('stock')->default(0);
            $table->integer('sold_count')->default(0);
            $table->string('sku')->nullable()->unique();
            
            // Categorization
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('category')->nullable(); // Legacy category field
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            
            // Media
            $table->json('images')->nullable();
            $table->json('tags')->nullable();
            
            // Status Flags
            $table->boolean('is_active')->default(true);
            $table->boolean('status')->default(true); // Legacy status field
            
            // Metadata & SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            
            // Analytics
            $table->integer('views_count')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            
            // Timestamps
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('vendor_id');
            $table->index('category_id');
            $table->index('is_active');
            $table->index('status');
            $table->index('rating');
            $table->index('created_at');
            $table->index(['vendor_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};