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
            // Add vendor_id column (nullable because global categories don't belong to a vendor)
            $table->foreignId('vendor_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
            
            // Add is_global column to distinguish between global and vendor-specific categories
            $table->boolean('is_global')->default(false)->after('vendor_id');
            
            // Add index for better performance
            $table->index(['vendor_id', 'is_global']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn(['vendor_id', 'is_global']);
        });
    }
};