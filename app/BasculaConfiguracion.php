<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasculaConfiguracion extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'bascula_configuracion';

     public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['id','cod_bascula', 'nom_bascula', 'ipx_bascula', 'est_bascula'];

    

}
