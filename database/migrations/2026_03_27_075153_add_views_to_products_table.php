<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // views_count already exists; drop the redundant 'views' column if it was added
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'views')) {
                $table->dropColumn('views');
            }
        });
    }

    public function down(): void
    {
        // nothing to reverse
    }
};
