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
        Schema::create('checkinout', function (Blueprint $table) {
            $table->id('id_check');
            $table->foreignId('id_reserva')->constrained('reserva', 'id_reserva');
            $table->date('confirm_in')->nullable();
            $table->date('confirm_out')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkinout');
    }
};
