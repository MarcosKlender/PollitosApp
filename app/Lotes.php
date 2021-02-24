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
        'peso_gavetas_pollos', 'peso_gavetas', 'peso_final', 'usuario', 'anulado', 'liquidado'
    ];

    public function registros()
    {
        return $this->hasMany(Registros::class);
    }

    public function scopeTipo($query, $tipo ){
    	if($tipo)
    		return $query->where('tipo', 'ilike', "%$tipo%");
    }

    public function scopeProveedor($query, $proveedor ){
    	if($proveedor)
    		return $query->where('proveedor', 'ilike', "%$proveedor%");
    }

    public function scopeProcedencia($query, $procedencia ){
    	if($procedencia)
    		return $query->where('procedencia', 'ilike', "%$procedencia%");
    }

    public function scopePlaca($query, $placa ){
    	if($placa)
    		return $query->where('placa', 'ilike', "%$placa%");
    }

    public function scopeConductor($query, $conductor ){
    	if($conductor)
    		return $query->where('conductor', 'ilike', "%$conductor%");
    }

     public function scopeUsuario($query, $usuario ){
    	if($usuario)
    		return $query->where('usuario', 'ilike', "%$usuario%");
    }

     public function scopeAnulado($query, $anulado ){
    	if($anulado)
    		return $query->where('anulado', $anulado);
    }

    public function scopeLiquidado($query, $liquidado ){
    	if($liquidado)
    		return $query->where('liquidado', $liquidado);
    }

     public function scopeFechaini($query, $fechaini ){
    	if($fechaini)
    		return $query->where('created_at', $fechaini);
    }

    public function scopeFechafin($query, $fechafin ){
    	if($fechafin)
    		return $query->where('created_at', $fechafin);
    }

}
