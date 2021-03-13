<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'proveedores';

    protected $fillable = [
                'pro_ruc','pro_nombre','pro_nombre_comercial','pro_telefonos','pro_email','pro_direccion',
                'created_at','updated_at'
    ];

    protected $primarykey = 'id';

    public $timestamps = true;


   public function ScopeNombre($query, $nombre){
		   	if($nombre)
		   	{
		   		return $query->where('pro_nombre','ilike',"%$nombre%");
		   	}
   }

   public function ScopeRazonsocial($query, $razonsocial){
		   	if($razonsocial){
		   			return $query->where('pro_nombre_comercial','ilike',"%$razonsocial");
		   	}
   }

   public function ScopeRuc_ci($query, $ruc_ci){
   			if($ruc_ci){
   					return $query->where('pro_ruc','like',"%$ruc_ci%");
   			}
   }

   /*public function ScopeCiudad($query, $ciudad){
   		if($ciudad){
   					return $query->where('ciudad','ilike',"%$ciudad%");
   		}
   } */


}
