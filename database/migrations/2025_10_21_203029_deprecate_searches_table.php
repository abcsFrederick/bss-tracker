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
        // Drop the table
        Schema::dropIfExists('searches');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-create the table
        Schema::create('searches', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('model_id');
            $table->string('model_title');
            $table->json('attributes');
            $table->timestamps();
        });
    }
};
