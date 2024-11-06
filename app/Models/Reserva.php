<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'reserva';
    protected $primaryKey = 'id_reserva';

    protected $fillable = [
        'id_cliente',
        'data_checkin',
        'data_checkout',
        'valor',
        'quartos',
        'status',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function quartos()
    {
        return $this->belongsToMany(Quarto::class, 'reserva_quarto', 'id_reserva', 'id_quarto');
    }

    public function checkinout()
    {
        return $this->hasOne(Checkinout::class, 'id_reserva', 'id_reserva');
    }

    public function acompanhantes() {
        return $this->hasMany(Acompanhante::class, 'id_reserva', 'id_reserva');
    }
}
