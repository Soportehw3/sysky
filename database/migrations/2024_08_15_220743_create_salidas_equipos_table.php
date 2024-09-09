<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidasEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipo_id');
            $table->unsignedBigInteger('empleado_id');
            $table->date('fecha_salida')->nullable();
            $table->date('fecha_regreso')->nullable();
            $table->string('nota_salida')->nullable();
            $table->string('nota_regreso')->nullable();
            $table->timestamps();

            // Definición de las claves foráneas
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salidas_equipos');
    }
}
