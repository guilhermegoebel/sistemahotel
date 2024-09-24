<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkinout extends Model
{
    use HasFactory;

    protected $table = 'checkinout';
    protected $primaryKey = 'id_check';

    protected $fillable = [
        'id_reserva',
        'confirm_in',
        'confirm_out',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva', 'id_reserva');
    }
}
