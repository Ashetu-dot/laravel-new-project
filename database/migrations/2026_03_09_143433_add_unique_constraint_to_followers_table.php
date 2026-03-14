<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Remove duplicate entries first - SQLite compatible
            $driver = DB::connection()->getDriverName();
            
            if ($driver === 'sqlite') {
                // SQLite compatible deletion
                DB::statement('
                    DELETE FROM followers 
                    WHERE id NOT IN (
                        SELECT MIN(id) 
                        FROM followers 
                        GROUP BY user_id, vendor_id
                    )
                ');
            } else {
                // MySQL compatible deletion
                DB::statement('
                    DELETE t1 FROM followers t1
                    INNER JOIN followers t2 
                    WHERE t1.id > t2.id 
                    AND t1.user_id = t2.user_id 
                    AND t1.vendor_id = t2.vendor_id
                ');
            }
            
            // Add unique constraint
            Schema::table('followers', function (Blueprint $table) {
                $table->unique(['user_id', 'vendor_id']);
            });
        } catch (\Exception $e) {
            // If constraint already exists, ignore
            if (!str_contains($e->getMessage(), 'Duplicate key name') && 
                !str_contains($e->getMessage(), 'UNIQUE constraint failed')) {
                throw $e;
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'vendor_id']);
        });
    }
};
