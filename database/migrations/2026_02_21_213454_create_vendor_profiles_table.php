<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_vendor_profiles_table.php

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
        Schema::create('vendor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('business_license')->nullable();
            $table->json('payment_info')->nullable();
            $table->json('shipping_policies')->nullable();
            $table->json('return_policies')->nullable();
            $table->decimal('commission_rate', 5, 2)->default(0);
            $table->decimal('total_earnings', 10, 2)->default(0);
            $table->decimal('withdrawn_amount', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            
            // Index
            $table->index('user_id');
            $table->index('verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_profiles');
    }
};