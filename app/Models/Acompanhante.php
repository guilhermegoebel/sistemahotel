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
        'id_cliente',
        'nome',
        'idade',
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
