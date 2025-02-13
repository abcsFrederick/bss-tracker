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
        Schema::table('samples', function (Blueprint $table) {
            $table->string('location_storage')->nullable();
        });

        // Retroactively populate
        DB::statement(
            "update samples JOIN locations ON samples.location_id = locations.id ".
            "set samples.location_storage = CONCAT(locations.location, ' ', IF(samples.location IS NOT NULL, samples.location, '')) ".
            "WHERE samples.location_storage is NULL"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->dropColumn(['location_storage']);
        });
    }
};
