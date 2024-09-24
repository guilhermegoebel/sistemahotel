<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaQuarto extends Model
{
    use HasFactory;

    protected $table = 'reserva_quarto';

    protected $fillable = [
        'id_reserva',
        'id_quarto',
    ];
}
