<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipo_id');
            $table->unsignedBigInteger('empleado_id');
            $table->date('fecha_prestamo');
            $table->date('fecha_regreso');
            $table->unsignedBigInteger('usuario_responsable_id')->nullable();
            $table->boolean('devuelto')->default(false);
            $table->timestamps();

            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('usuario_responsable_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
