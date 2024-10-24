<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            // Agregar las nuevas columnas
            $table->unsignedBigInteger('tipo_equipo_id')->nullable()->after('etiqueta_skytex');
            $table->unsignedBigInteger('marca_id')->nullable()->after('numero_serie');

            // Añadir las claves foráneas
            $table->foreign('tipo_equipo_id')->references('id')->on('tipos_equipos')->onDelete('set null');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('set null');

            // Eliminar las columnas antiguas
            $table->dropColumn(['marca', 'tipo']);
        });
    }

    public function down(): void
    {
        Schema::table('equipos', function (Blueprint $table) {
            // Restaurar las columnas antiguas
            $table->string('marca', 50)->nullable();
            $table->string('tipo', 100)->nullable();

            // Eliminar las claves foráneas y columnas nuevas
            $table->dropForeign(['tipo_equipo_id']);
            $table->dropForeign(['marca_id']);
            $table->dropColumn(['tipo_equipo_id', 'marca_id']);
        });
    }
};
