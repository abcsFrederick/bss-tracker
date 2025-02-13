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
        Schema::table('bio_samples', function (Blueprint $table) {
            $table->string('location_storage')->nullable();
        });

        // Retroactively populate
        DB::statement(
            "update bio_samples JOIN locations ON bio_samples.location_id = locations.id ".
            "set bio_samples.location_storage = CONCAT(locations.location, ' ', IF(bio_samples.location IS NOT NULL, bio_samples.location, '')) ".
            "WHERE bio_samples.location_storage is NULL"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bio_samples', function (Blueprint $table) {
            $table->dropColumn(['location_storage']);
        });
    }
};
