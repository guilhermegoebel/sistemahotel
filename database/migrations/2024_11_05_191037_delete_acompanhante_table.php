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
        Schema::dropIfExists('acompanhante');
    }

    public function down(): void
    {
        Schema::create('acompanhante', function (Blueprint $table) {
            $table->id('id_acompanhante');
            $table->foreignId('id_reserva')->constrained('reserva', 'id_reserva');
            $table->string('nome');
            $table->integer('idade');
        });
    }
};
