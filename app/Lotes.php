<?php

namespace App;

use App\Registros;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo', 'proveedor', 'procedencia', 'placa', 'conductor', 'cant_gavetas', 'cant_pollos',
        'peso_gavetas_pollos', 'peso_gavetas', 'peso_final', 'usuario', 'anulado'
    ];

    public function registros()
    {
        return $this->hasMany(Registros::class);
    }
}
