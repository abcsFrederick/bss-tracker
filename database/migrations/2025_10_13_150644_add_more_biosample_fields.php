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
            // Add the columns
            $table->string('organism')->default('NA');
            $table->string('organ_system')->default('NA');
            $table->string('tissue_location')->default('NA');
            $table->string('cell_type')->default('NA');
            $table->string('organelle')->default('NA');
            $table->enum('is_native', ['Yes','No','Unknown'])->default('Unknown');
            $table->string('intrinsic_variables')->default('NA')->nullable();
            $table->string('extrinsic_variables')->default('NA')->nullable();
            $table->string('experimental_variables')->default('NA')->nullable();
            $table->enum('cell_context', ['Tissue','Cell','Cell Line','Unknown'])->default('Unknown');
            $table->enum('is_diseased', ['Healthy','Diseased','Unknown'])->default('Unknown');
            $table->string('pathology')->default('NA')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bio_samples', function (Blueprint $table) {
            // Remove the columns
            $table->dropColumn(['organism']);
            $table->dropColumn(['organ_system']);
            $table->dropColumn(['tissue_location']);
            $table->dropColumn(['cell_type']);
            $table->dropColumn(['organelle']);
            $table->dropColumn(['is_native']);
            $table->dropColumn(['intrinsic_variables']);
            $table->dropColumn(['extrinsic_variables']);
            $table->dropColumn(['experimental_variables']);
            $table->dropColumn(['cell_context']);
            $table->dropColumn(['is_diseased']);
            $table->dropColumn(['pathology']);
            
        });
    }
};
