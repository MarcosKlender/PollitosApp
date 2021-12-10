<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entregas extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo','cliente', 'ruc_ci','placa', 'conductor', 'peso_entrega', 'usuario', 'anulado', 'observaciones'
    ];

}
