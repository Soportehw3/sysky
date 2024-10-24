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
        Schema::create('licencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_licencia_id')->nullable(); // usuario_responsable INT
            $table->string('nombre'); // Nombre de la licencia o suscripción
            $table->date('fecha_adquisicion'); // Fecha en la que se adquirió
            $table->enum('frecuencia_pago', ['mensual', 'semestral', 'anual']); // Frecuencia de pago
            $table->date('fecha_siguiente_pago'); // Fecha del próximo pago
            $table->date('fecha_recordatorio'); // Fecha del recordatorio
            $table->enum('estado', ['activa', 'vencida', 'cancelada']); // Estado de la licencia
            $table->unsignedBigInteger('usuario_responsable')->nullable(); // usuario_responsable INT
            $table->text('observaciones')->nullable(); // Observaciones adicionales
            $table->timestamps();

            $table->foreign('tipo_licencia_id')->references('id')->on('tipos_licencias')->onDelete('cascade');
            $table->foreign('usuario_responsable')->references('id')->on('users')->onDelete('cascade');

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licencias');
    }
};
