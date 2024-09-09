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
        Schema::create('asignaciones_equipos', function (Blueprint $table) {
            $table->id()->unique(); 
            $table->unsignedBigInteger('empleado_id')->nullable(); 
            $table->unsignedBigInteger('equipo_id')->nullable(); 
            $table->date('fecha_asignacion')->nullable(); 
            $table->unsignedBigInteger('usuario_responsable')->nullable(); 
            $table->integer('ticket')->nullable(); 
            $table->string('nota_descriptiva', 100)->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable(); 
            $table->string('estado', 50)->nullable(); // Nueva columna estado
            $table->timestamps(); 

            // Definición de las claves foráneas
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('usuario_responsable')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asignaciones_equipos', function (Blueprint $table) {
            $table->dropForeign(['empleado_id']);
            $table->dropForeign(['equipo_id']);
            $table->dropForeign(['usuario_responsable']);
            $table->dropForeign(['empresa_id']);
        });

        Schema::dropIfExists('asignaciones_equipos');
    }
};
