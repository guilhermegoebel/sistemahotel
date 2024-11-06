<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acompanhante extends Model
{
    use HasFactory;

    protected $table = 'acompanhante';
    protected $primaryKey = 'id_acompanhante';
    public $timestamps = false;

    protected $fillable = [
        'id_reserva',
        'nome',
        'idade',
    ];

    public function reserva() {
        return $this->belongsTo(Reserva::class, 'id_reserva', 'id_reserva');
    }
}
