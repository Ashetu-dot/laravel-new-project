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
            // ROLE & STATUS - THIS FIXES YOUR ERROR
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('customer')->after('password');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable();
            }
            
            // VENDOR BUSINESS INFORMATION
            if (!Schema::hasColumn('users', 'tax_id')) {
                $table->string('tax_id')->nullable();
            }
            if (!Schema::hasColumn('users', 'website')) {
                $table->string('website')->nullable();
            }
            if (!Schema::hasColumn('users', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            
            // ADDRESS INFORMATION - COMPLETE ADDRESS FIELDS
            if (!Schema::hasColumn('users', 'address_line1')) {
                $table->string('address_line1')->nullable();
            }
            if (!Schema::hasColumn('users', 'address_line2')) {
                $table->string('address_line2')->nullable();
            }
            if (!Schema::hasColumn('users', 'zip_code')) {
                $table->string('zip_code')->nullable();
            }
            if (!Schema::hasColumn('users', 'country')) {
                $table->string('country')->default('USA');
            }
            
            // VENDOR STATS
            if (!Schema::hasColumn('users', 'total_reviews')) {
                $table->integer('total_reviews')->default(0);
            }
            
            // UPDATE EXISTING COLUMN DEFAULTS IF NEEDED
            if (Schema::hasColumn('users', 'rating')) {
                $table->decimal('rating', 3, 2)->default(0)->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'role',
                'is_active',
                'last_login_at',
                'tax_id',
                'website',
                'description',
                'phone',
                'address_line1',
                'address_line2',
                'zip_code',
                'country',
                'total_reviews',
            ];
            
            // Only drop columns that exist
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
            
            // Revert rating default if needed
            if (Schema::hasColumn('users', 'rating')) {
                $table->decimal('rating', 3, 2)->default(4.5)->change();
            }
        });
    }
};