<?php

namespace App;

use App\Egresos;
use App\Visceras;
use App\Registros;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo', 'cantidad', 'proveedor', 'ruc_ci', 'procedencia', 'placa', 'conductor', 'peso_bruto',
        'cant_gavetas', 'peso_gavetas', 'peso_final', 'usuario', 'anulado', 'liquidado', 'visceras',
        'egresos', 'id','lote_id','created_at', 'observaciones', 'cant_ahogados', 'peso_ahogados'
    ];

    public function registros()
    {
        return $this->hasMany(Registros::class);
    }

    public function visceras()
    {
        return $this->hasMany(Visceras::class);
    }

    public function egresos()
    {
        return $this->hasMany(Egresos::class);
    }

    public function scopeAll_index($query)
    {
        return $query->leftJoin('registros', 'registros.lotes_id', '=', 'lotes.id')->select(
            'lotes.*',
            DB::raw('sum(registros.cant_gavetas) as total_cant_gavetas'),
            DB::raw('sum(registros.peso_bruto) as total_peso_bruto'),
            DB::raw('sum(registros.peso_gavetas) as total_peso_gavetas'),
            DB::raw('sum(registros.peso_final) as total_peso_final')
        )
                        ->groupBy('registros.lotes_id', 'lotes.id');
    }

    public function scopeLote($query, $lote)
    {
        if ($lote) {
            return $query->where('lotes.id', 'ilike', "%$lote%");
        }
    }

    public function scopeTipo($query, $tipo)
    {
        if ($tipo) {
            return $query->where('lotes.tipo', 'ilike', "%$tipo%");
        }
    }

    public function scopeProveedor($query, $proveedor)
    {
        if ($proveedor) {
            return $query->where('lotes.proveedor', 'ilike', "%$proveedor%");
        }
    }

    public function scopeProcedencia($query, $procedencia)
    {
        if ($procedencia) {
            return $query->where('lotes.procedencia', 'ilike', "%$procedencia%");
        }
    }

    public function scopePlaca($query, $placa)
    {
        if ($placa) {
            return $query->where('lotes.placa', 'ilike', "%$placa%");
        }
    }

    public function scopeConductor($query, $conductor)
    {
        if ($conductor) {
            return $query->where('lotes.conductor', 'ilike', "%$conductor%");
        }
    }

    public function scopeUsuario($query, $usuario)
    {
        if ($usuario) {
            return $query->where('lotes.usuario', 'ilike', "%$usuario%");
        }
    }

    public function scopeAnulado($query, $anulado)
    {
        if ($anulado) {
            return $query->where('lotes.anulado', $anulado);
        }
    }

    public function scopeLiquidado($query, $liquidado)
    {
        if ($liquidado) {
            return $query->where('lotes.liquidado', $liquidado);
        }
    }

    public function scopeFecha($query, $fechaini, $fechafin)
    {
        if ($fechaini && $fechafin) {
            return $query->whereDate('lotes.created_at', '>=', [$fechaini])->whereDate('lotes.created_at', '<=', [$fechafin]);
        }
        //  return $query->whereBetween('lotes.created_at',[$fechaini, $fechafin]);
    }
}
