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
        Schema::table('prestamos', function (Blueprint $table) {
            $table->string('nota_prestamo')->nullable()->after('fecha_regreso');
        });
    }

    public function down()
    {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->dropColumn('nota_prestamo');
        });
    }
};
