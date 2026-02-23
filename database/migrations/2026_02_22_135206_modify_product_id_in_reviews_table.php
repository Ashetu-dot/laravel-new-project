<?php
// database/migrations/xxxx_xx_xx_xxxxxx_modify_product_id_in_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Make product_id nullable
            $table->foreignId('product_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Revert back to not nullable (this might fail if there are null values)
            $table->foreignId('product_id')->nullable(false)->change();
        });
    }
};