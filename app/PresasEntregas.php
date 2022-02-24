<?php

namespace App;

use App\Entregas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PresasEntregas extends Model
{
    use HasFactory;

    protected $fillable = [
        'entregas_id', 'tipo_entrega', 'cant_gavetas', 'tipo_peso',
        'peso_bruto', 'usuario_creacion','usuario_modificacion', 'anulado', 'observaciones'
    ];

    public function lote()
    {
        return $this->belongsTo(Entregas::class, 'entregas_id');
    }
}
