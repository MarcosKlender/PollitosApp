<?php

namespace App;

use App\PresasEntregas;
use App\RegistrosEntregas;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entregas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','tipo', 'ruc_ci', 'cliente', 'placa', 'conductor', 'destino',
        'cant_animales', 'usuario', 'anulado', 'liquidado', 'observaciones'
    ];

    public function scopeAll_index($query)
    {
        return $query->leftJoin('registros_entregas', 'registros_entregas.entregas_id', '=', 'entregas.id')->select(
            'entregas.*',
            DB::raw('sum(registros_entregas.cant_gavetas) as total_cant_gavetas'),
            DB::raw('sum(registros_entregas.peso_bruto) as total_peso_bruto')
        )->where('registros_entregas.anulado', 0)
        ->groupBy('registros_entregas.entregas_id', 'entregas.id');
    }

    public function scopePresas_entregas($query)
    {
        return $query->leftJoin('presas_entregas', 'presas_entregas.entregas_id', '=', 'entregas.id')->select(
            'entregas.*',
            DB::raw('sum(presas_entregas.cant_gavetas) as total_cant_gavetas'),
            DB::raw('sum(presas_entregas.peso_bruto) as total_peso_gavetas')
        )->where('presas_entregas.anulado', 0)
        ->groupBy('presas_entregas.entregas_id', 'entregas.id');
    }


    public function scopeIdEntregas($query, $entregas)
    {
        if ($entregas) {
            return $query->where('entregas.id', 'ilike', "%$entregas%");
        }
    }

    public function scopeTipo($query, $tipo)
    {
        if ($tipo) {
            return $query->where('entregas.tipo', 'ilike', "%$tipo%");
        }
    }

    public function scopeCliente($query, $cliente)
    {
        if ($cliente) {
            return $query->where('entregas.cliente', 'ilike', "%$cliente%");
        }
    }

    public function scopeIdentificacion($query, $ruc_ci)
    {
        if ($ruc_ci) {
            return $query->where('entregas.ruc_ci', 'ilike', "%$ruc_ci%");
        }
    }

    public function scopeConductor($query, $conductor)
    {
        if ($conductor) {
            return $query->where('entregas.conductor', 'ilike', "%$conductor%");
        }
    }

    public function scopeUsuario($query, $usuario)
    {
        if ($usuario) {
            return $query->where('entregas.usuario', 'ilike', "%$usuario%");
        }
    }

    public function scopeAnulado($query, $anulado)
    {
        if ($anulado) {
            return $query->where('entregas.anulado', $anulado);
        }
    }

    public function scopeLiquidado($query, $liquidado)
    {
        if ($liquidado) {
            return $query->where('entregas.liquidado', $liquidado);
        }
    }

    public function scopeFecha($query, $fechaini, $fechafin)
    {
        if ($fechaini && $fechafin) {
            return $query->whereDate('entregas.created_at', '>=', [$fechaini])->whereDate('entregas.created_at', '<=', [$fechafin]);
        }
    }
}
