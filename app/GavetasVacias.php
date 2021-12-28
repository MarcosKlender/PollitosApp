<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GavetasVacias extends Model
{
    use HasFactory;

    protected $fillable = [
        'lotes_id', 'cant_gavetas_vacias', 'peso_gavetas_vacias', 'peso_final_gavetas','tipo_peso', 'usuario', 'anulado', 'observaciones'
    ];

    public function lote()
    {
        return $this->belongsTo(Lotes::class, 'lotes_id');
    }
}
