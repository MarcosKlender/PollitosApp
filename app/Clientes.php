<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $tabla = 'clientes';

    protected $fillable = [
    	'tipo','ruc_ci','nombres','razon_social','direccion','telefono','movil','email','provincia','ciudad','parroquia'
    ];

    protected $primarykey = 'id';

    public $timestamps = false;


    public function ScopeNombre($query, $nombre){
		   	if($nombre)
		   	{
		   		return $query->where('nombres','ilike',"%$nombre%");
		   	}
   }

   public function ScopeRazonsocial($query, $razonsocial){
		   	if($razonsocial){
		   			return $query->where('razon_social','ilike',"%$razonsocial");
		   	}
   }

   public function ScopeRuc_ci($query, $ruc_ci){
   			if($ruc_ci){
   					return $query->where('ruc_ci','like',"%$ruc_ci%");
   			}
   }

   public function ScopeCiudad($query, $ciudad){
   		if($ciudad){
   					return $query->where('ciudad','ilike',"%$ciudad%");
   		}
   }


}
