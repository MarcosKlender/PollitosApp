<?php

namespace App;

use App\Entregas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrosEntregas extends Model
{
    use HasFactory;

    protected $fillable = [
        'entregas_id', 'cant_gavetas', 'tipo_peso', 'peso_bruto', 'categoria_animales' , 'usuario_creacion', 'anulado', 'observaciones'
    ];

    public function lote()
    {
        return $this->belongsTo(Entregas::class, 'entregas_id');
    }
}
