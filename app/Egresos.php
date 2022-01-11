<?php

namespace App;

use App\Lotes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Egresos extends Model
{
    use HasFactory;

    protected $fillable = [
        'lotes_id', 'cant_gavetas', 'peso_bruto', 'peso_gavetas', 'peso_final', 'tipo_peso', 'usuario', 'liquidado', 'anulado', 'observaciones','create_at'
    ];

    public function lote()
    {
        return $this->belongsTo(Lotes::class, 'lotes_id');
    }
}
