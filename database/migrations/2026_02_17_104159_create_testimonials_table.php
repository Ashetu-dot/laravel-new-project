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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();

            // Author information
            $table->string('author_name');
            $table->string('author_role')->nullable();
            $table->string('author_image')->nullable()->comment('Path to author image or avatar');
            $table->text('content');

            // Rating and review metrics
            $table->decimal('rating', 2, 1)->nullable()->comment('Rating from 1-5 stars');

            // Status and display
            $table->boolean('is_active')->default(true);
            $table->boolean('verified')->default(false)->comment('Whether testimonial is verified as genuine');
            $table->boolean('featured')->default(false)->comment('Whether testimonial is featured on homepage');
            $table->integer('sort_order')->default(0);

            // Relationships
            $table->foreignId('vendor_id')->nullable()->constrained('users')->onDelete('cascade')->comment('If testimonial is for specific vendor');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade')->comment('If testimonial is for specific product');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->comment('User who wrote the testimonial');

            // Response from vendor/business
            $table->text('response')->nullable()->comment('Response from vendor to testimonial');
            $table->timestamp('response_date')->nullable()->comment('When the response was added');

            // Meta data
            $table->string('ip_address')->nullable()->comment('IP address of the submitter');
            $table->string('user_agent')->nullable()->comment('Browser/user agent of the submitter');
            $table->timestamp('verified_at')->nullable()->comment('When testimonial was verified');

            $table->timestamps();

            // Indexes for better performance
            $table->index('is_active');
            $table->index('verified');
            $table->index('featured');
            $table->index('sort_order');
            $table->index('rating');
            $table->index('vendor_id');
            $table->index('product_id');
            $table->index('user_id');
            $table->index('created_at');

            // Composite indexes for common queries
            $table->index(['is_active', 'verified']);
            $table->index(['is_active', 'featured']);
            $table->index(['vendor_id', 'is_active']);
            $table->index(['product_id', 'is_active']);
            $table->index(['rating', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
