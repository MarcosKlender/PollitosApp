<?php

namespace App;

use App\Lotes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgresosPresas extends Model
{
    use HasFactory;

    protected $fillable = [
    		"id","lotes_id", "cant_ahogados_egresos", "peso_ahogados_egresos", "cant_gvacia_ahogados_egresos", "cant_estropeados_egresos", "peso_estropeados_egresos", "cant_gvacia_estropeados_egresos", "peso_mollejas_egresos", "cant_gvacia_mollejas_egresos", "usuario_creacion", "usuario_modificacion", "estado_egreso_presas"
    ];

}
