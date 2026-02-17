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
        Schema::table('users', function (Blueprint $table) {
            // Check if columns already exist to avoid duplication
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'location')) {
                $table->string('location')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'state')) {
                $table->string('state')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'country')) {
                $table->string('country')->default('Ethiopia');
            }
            
            if (!Schema::hasColumn('users', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable();
            }
            
            if (!Schema::hasColumn('users', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable();
            }
            
            // Create indexes for better search performance
            $table->index(['city', 'state', 'country']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['city', 'location', 'state', 'country', 'latitude', 'longitude'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};