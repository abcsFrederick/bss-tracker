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
            // Add the column
            $table->text('image_directory')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specimens', function (Blueprint $table) {
            // Remove the column
            $table->dropColumn(['image_directory']);
        });
    }
};
