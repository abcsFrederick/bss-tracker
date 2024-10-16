<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('samples', function (Blueprint $table) {
            // Change the protocol and protocol_filename columns type to json
            DB::statement('UPDATE samples SET protocol = JSON_ARRAY(protocol) WHERE protocol IS NOT NULL');
            DB::statement('UPDATE samples SET protocol_filename = JSON_ARRAY(protocol_filename)');
            $table->json('protocol')->change();
            $table->json('protocol_filename')->default(json_encode(array()))->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('samples', function (Blueprint $table) {
            // Change the protocol column type to string 255
            $table->string('protocol', 255)->change();
            $table->text('protocol_filename')->default('')->change();
        });
    }
};
