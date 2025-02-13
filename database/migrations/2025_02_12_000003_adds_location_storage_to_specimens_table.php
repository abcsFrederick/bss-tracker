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
        Schema::table('specimens', function (Blueprint $table) {
            $table->string('location_storage')->nullable();
        });

        // Retroactively populate
        DB::statement(
            "update specimens JOIN locations ON specimens.location_id = locations.id ".
            "set specimens.location_storage = CONCAT(locations.location, ' ', IF(specimens.location IS NOT NULL, specimens.location, '')) ".
            "WHERE specimens.location_storage is NULL"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specimens', function (Blueprint $table) {
            $table->dropColumn(['location_storage']);
        });
    }
};
