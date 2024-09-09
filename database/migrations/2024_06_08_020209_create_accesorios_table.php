<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('accesorios', function (Blueprint $table) {
            $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('descripcion', 150)->nullable(); // descripcion VARCHAR(150)
            $table->string('marca', 50)->nullable(); // marca VARCHAR(50)
            $table->string('modelo', 50)->nullable(); // modelo VARCHAR(50)
            $table->integer('cantidad')->nullable(); // cantidad INT
            $table->string('orden_compra_acc', 50)->nullable(); // orden_compra_acc VARCHAR(50)
            $table->string('requisicion', 50)->nullable(); // requisicion VARCHAR(50)
            $table->integer('cantidad_minima')->default(1);
            $table->unsignedBigInteger('empleado_id')->nullable(); // empleado_id BIGINT
            $table->timestamps(); // Agrega created_at y updated_at
            
            // Foreign key constraint
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('accesorios');
    }
};
