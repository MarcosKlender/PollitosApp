<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entregas extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente', 'placa', 'conductor', 'peso_entrega', 'usuario', 'anulado', 'observaciones'
    ];

}