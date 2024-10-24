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
        Schema::create('pagos_licencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('licencia_id')->constrained('licencias')->onDelete('cascade');
            $table->decimal('monto', 10, 2); // Monto del pago
            $table->date('fecha_pago'); // Fecha del pago
            $table->text('detalle')->nullable(); // Detalles adicionales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_licencias');
    }
};
