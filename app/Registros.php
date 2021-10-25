<?php

namespace App;

use App\Lotes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registros extends Model
{
    use HasFactory;

    protected $fillable = [
        'lotes_id', 'cant_gavetas', 'cant_pollos', 'peso_bruto', 'peso_gavetas', 'peso_final',
        'tipo_peso', 'usuario', 'anulado', 'observaciones'
    ];

    public function lote()
    {
        return $this->belongsTo(Lotes::class, 'lotes_id');
    }
}
