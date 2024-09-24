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
        Schema::create('reserva_quarto', function (Blueprint $table) {
            $table->foreignId('id_reserva')->constrained('reserva', 'id_reserva')->onDelete('cascade');
            $table->foreignId('id_quarto')->constrained('quarto', 'id_quarto')->onDelete('cascade');
            $table->primary(['id_reserva', 'id_quarto']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reserva_quarto');
    }
};
