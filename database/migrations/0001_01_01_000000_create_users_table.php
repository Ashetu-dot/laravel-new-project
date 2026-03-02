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
            $table->boolean('is_verified')->default(false); // <-- ADD THIS LINE
            $table->timestamp('vendor_verified_at')->nullable(); // <-- OPTIONAL: timestamp when verified
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
            $table->string('country')->default('Ethiopia');
            
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
            
            // PAYMENT INFORMATION - UPDATED FOR CHAPA
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('bank_code')->nullable(); // For Chapa bank transfers
            $table->string('account_holder_name')->nullable(); // Account holder name for bank transfers
            $table->string('mobile_money_number')->nullable(); // For Ethiopia: Telebirr, M-Pesa etc.
            $table->string('mobile_money_provider')->nullable(); // 'telebirr', 'mpesa', 'amole'
            
            // CHAPA SPECIFIC FIELDS
            $table->string('chapa_customer_id')->nullable(); // Chapa customer reference
            $table->string('payment_method')->default('chapa'); // Default payment method
            $table->json('payment_settings')->nullable(); // Store payment preferences
            
            // VENDOR PAYOUT SETTINGS
            $table->string('payout_method')->default('bank'); // 'bank', 'mobile_money', 'chapa'
            $table->json('payout_settings')->nullable(); // Store payout preferences
            
            // TRANSACTION STATS
            $table->decimal('total_earnings', 12, 2)->default(0); // Total earnings from sales
            $table->decimal('pending_payouts', 12, 2)->default(0); // Amount pending for payout
            $table->decimal('lifetime_balance', 12, 2)->default(0); // Lifetime earnings
            
            // CHAPA WEBHOOK & VERIFICATION
            $table->string('webhook_secret')->nullable(); // For webhook verification
            $table->timestamp('last_payment_at')->nullable(); // Last payment timestamp
            
            // INDEXES FOR BETTER PERFORMANCE
            $table->index(['role', 'is_active']);
            $table->index('city');
            $table->index('state');
            $table->index('country');
            $table->index('category');
            $table->index('rating');
            $table->index('created_at');
            $table->index('chapa_customer_id'); // Index for Chapa lookups
            $table->index('payout_method'); // Index for payout queries
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

        // NEW TABLE: Transactions table for Chapa payments
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_reference')->unique(); // Chapa transaction reference
            $table->string('tx_ref')->unique(); // Your unique transaction reference
            $table->decimal('amount', 12, 2);
            $table->string('currency')->default('ETB'); // Ethiopian Birr
            $table->string('status')->default('pending'); // pending, success, failed, refunded
            $table->string('payment_method')->nullable(); // 'telebirr', 'bank', 'card'
            $table->string('channel')->nullable(); // Chapa payment channel
            
            // Customer information
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            
            // Product/Service details
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable(); // Additional data
            
            // Chapa specific fields
            $table->string('chapa_transaction_id')->nullable(); // Chapa's transaction ID
            $table->json('chapa_response')->nullable(); // Full Chapa response
            $table->string('webhook_reference')->nullable(); // Webhook reference
            
            // Timestamps
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('status');
            $table->index('user_id');
            $table->index('tx_ref');
            $table->index('transaction_reference');
            $table->index('created_at');
        });

        // NEW TABLE: Vendor payouts
        Schema::create('vendor_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->string('currency')->default('ETB');
            $table->string('status')->default('pending'); // pending, processing, completed, failed
            $table->string('payout_method'); // bank, mobile_money, chapa
            
            // Payout details
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('mobile_money_number')->nullable();
            $table->string('mobile_money_provider')->nullable();
            
            // Chapa payout reference
            $table->string('chapa_payout_id')->nullable();
            $table->string('transaction_reference')->nullable();
            
            // Metadata
            $table->json('metadata')->nullable();
            $table->text('notes')->nullable();
            
            // Timestamps
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('status');
            $table->index('vendor_id');
            $table->index('chapa_payout_id');
        });

        // NEW TABLE: Payment logs for debugging
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); // webhook, payment_init, payment_success, payment_failed
            $table->string('transaction_reference')->nullable();
            $table->json('payload')->nullable();
            $table->json('response')->nullable();
            $table->string('status')->nullable();
            $table->text('error_message')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            
            $table->index('event_type');
            $table->index('transaction_reference');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
        Schema::dropIfExists('vendor_payouts');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};