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
                'tipo','ruc_ci','nombres','razon_social','direccion','telefono','movil','email',
                'provincia','ciudad','parroquia','created_at','updated_at'
    ];

    protected $primarykey = 'ruc_ci';

    public $timestamps = false;
}
