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
    Schema::create('impresoras', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('marca');
        $table->string('modelo');
        $table->string('ip')->unique();
        $table->string('area');
        $table->boolean('en_linea')->default(false); // Indica si la impresora está en línea
        $table->string('estado')->nullable(); // Guardará el estado o error actual
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impresoras');
    }
};
