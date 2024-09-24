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
        Schema::create('reserva', function (Blueprint $table) {
            $table->id('id_reserva');
            $table->foreignId('id_cliente')->constrained('cliente', 'id_cliente');
            $table->date('data_checkin');
            $table->date('data_checkout');
            $table->float('valor');
            $table->integer('quartos');
            $table->enum('status', ['pendente', 'confirmada', 'cancelada', 'completa'])->default('pendente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};
