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
        Schema::create('asignaciones_accesorios', function (Blueprint $table) {
            $table->id()->unique(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('empleado_id')->nullable(); // empleado_id INT
            $table->unsignedBigInteger('accesorio_id')->nullable(); // accesorio_id INT
            $table->integer('cantidad_asignada')->nullable(); // cantidad_asignada INT NOT NULL
            $table->date('fecha_asignacion')->nullable(); // fecha_asignacion DATE NOT NULL
            $table->unsignedBigInteger('usuario_responsable')->nullable(); // usuario_responsable INT
            $table->integer('ticket')->nullable(); // ticket INT
            $table->string('nota_descriptiva', 100)->nullable(); // nota_descriptiva VARCHAR(100)
            $table->timestamps(); // Agrega created_at y updated_at

            // Definición de las claves foráneas
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('accesorio_id')->references('id')->on('accesorios')->onDelete('cascade');
            $table->foreign('usuario_responsable')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones_accesorios');
    }
};
