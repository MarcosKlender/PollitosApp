<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entregas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','tipo', 'ruc_ci', 'cliente', 'placa', 'conductor', 'destino',
        'cant_animales', 'usuario', 'anulado', 'liquidado', 'observaciones'
    ];
}
