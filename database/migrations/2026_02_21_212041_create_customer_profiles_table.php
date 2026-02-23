<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_customer_profiles_table.php

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
        Schema::create('customer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('preferences')->nullable();
            $table->json('saved_vendors')->nullable();
            $table->json('search_history')->nullable();
            $table->json('payment_methods')->nullable();
            $table->json('shipping_addresses')->nullable();
            $table->timestamps();
            
            // Index
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_profiles');
    }
};