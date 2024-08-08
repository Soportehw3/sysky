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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id()->unique(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('numero_nomina', 50)->nullable(); // numero_nomina VARCHAR(50) UNIQUE NOT NULL
            $table->string('nombre', 100)->nullable(); // nombre VARCHAR(100) NOT NULL
            $table->string('apellidoP', 100)->nullable(); // nombre VARCHAR(100) NOT NULL
            $table->string('apellidoM', 100)->nullable(); // nombre VARCHAR(100) NOT NULL
            $table->string('puesto', 100)->nullable(); // puesto VARCHAR(100) NOT NULL
            $table->string('area', 100)->nullable(); // area VARCHAR(100) NOT NULL
            $table->string('status',100)->nullable();
            $table->timestamps(); // Agrega created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
