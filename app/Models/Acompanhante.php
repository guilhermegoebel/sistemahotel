<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acompanhante extends Model
{
    use HasFactory;

    protected $table = 'acompanhante';
    protected $primaryKey = 'id_acompanhante';

    protected $fillable = [
        'id_reserva',
        'nome',
        'tipo',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva', 'id_reserva');
    }
}
