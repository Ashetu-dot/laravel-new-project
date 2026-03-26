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
            if (!Schema::hasColumn('categories', 'vendor_id')) {
                $table->foreignId('vendor_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('categories', 'is_global')) {
                $table->boolean('is_global')->default(false)->after('vendor_id');
            }
            if (!Schema::hasIndex('categories', 'categories_vendor_id_is_global_index')) {
                $table->index(['vendor_id', 'is_global']);
            }
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