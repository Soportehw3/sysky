<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('accesorios', function (Blueprint $table) {
            // Agregar la nueva columna marca_id
            $table->unsignedBigInteger('marca_id')->nullable()->after('descripcion');

            // Añadir la clave foránea
            $table->foreign('marca_id')->references('id')->on('marcas_accesorios')->onDelete('set null');

            // Eliminar la columna antigua marca
            $table->dropColumn('marca');
        });
    }

    public function down(): void
    {
        Schema::table('accesorios', function (Blueprint $table) {
            // Restaurar la columna antigua marca
            $table->string('marca', 50)->nullable();

            // Eliminar la clave foránea y la columna marca_id
            $table->dropForeign(['marca_id']);
            $table->dropColumn('marca_id');
        });
    }
};
