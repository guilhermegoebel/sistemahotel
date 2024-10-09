<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corre as migrações.
     */
    public function up(): void
    {
        Schema::table('reserva', function (Blueprint $table) {
            $table->dropColumn('quartos'); //F quartos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reserva', function (Blueprint $table) {
            $table->json('quartos')->after('valor'); //Se algum dia querer meter quarto de volta
        });
    }
};
