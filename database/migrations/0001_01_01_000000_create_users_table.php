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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // ROLE & STATUS
            $table->string('role')->default('customer'); // customer, vendor, admin
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
            
            // VENDOR BUSINESS INFORMATION
            $table->string('business_name')->nullable();
            $table->string('category')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            
            // ADDRESS INFORMATION
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->default('Ethiopia'); // Changed from USA to Ethiopia
            
            // ADDITIONAL LOCATION FIELDS (for better search)
            $table->string('location')->nullable(); // Full location string
            $table->decimal('latitude', 10, 8)->nullable(); // For geolocation
            $table->decimal('longitude', 11, 8)->nullable(); // For geolocation
            
            // MEDIA & BRANDING
            $table->string('avatar')->nullable();
            $table->string('main_image')->nullable();
            $table->string('sub_image_1')->nullable();
            $table->string('sub_image_2')->nullable();
            
            // VENDOR STATS
            $table->integer('products_count')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            
            // STORE VIEWS (for vendor dashboard)
            $table->integer('store_views')->default(0);
            
            // SOCIAL MEDIA LINKS
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('telegram_url')->nullable();
            $table->string('twitter_url')->nullable();
            
            // BUSINESS HOURS (JSON field for flexibility)
            $table->json('business_hours')->nullable();
            
            // PAYMENT INFORMATION
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('mobile_money_number')->nullable(); // For Ethiopia: Telebirr, M-Pesa etc.
            
            // INDEXES FOR BETTER PERFORMANCE
            $table->index(['role', 'is_active']);
            $table->index('city');
            $table->index('state');
            $table->index('country');
            $table->index('category');
            $table->index('rating');
            $table->index('created_at');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};