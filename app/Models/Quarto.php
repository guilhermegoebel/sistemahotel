<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    use HasFactory;

    protected $table = 'quarto';
    protected $primaryKey = 'id_quarto';
    public $timestamps = false;

    protected $fillable = [
        'valor',
        'tipo',
    ];

    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'reserva_quarto', 'id_quarto', 'id_reserva');
    }
}
