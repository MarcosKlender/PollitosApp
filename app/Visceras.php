<?php

namespace App;

use App\Lotes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visceras extends Model
{
    use HasFactory;

    protected $fillable = [
        'lotes_id', 'tipo', 'peso_bruto', 'peso_gavetas', 'peso_final', 'usuario', 'anulado', 'observaciones'
    ];

    public function lote()
    {
        return $this->belongsTo(Lotes::class, 'lotes_id');
    }
}
