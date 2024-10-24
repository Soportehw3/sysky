<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('salidas_equipos', function (Blueprint $table) {
            $table->string('imagen_regreso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('salidas_equipos', function (Blueprint $table) {
            $table->dropColumn('imagen_regreso');
        });
    }
};
