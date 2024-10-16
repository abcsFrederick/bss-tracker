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
        Schema::table('projects', function (Blueprint $table) {
            // Change the attachment column type to json
            DB::statement('UPDATE projects SET attachment = JSON_ARRAY(attachment) WHERE attachment IS NOT NULL');
            $table->json('attachment')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Change the attachment column type to string 255
            $table->string('attachment', 255)->change();
        });
    }
};
