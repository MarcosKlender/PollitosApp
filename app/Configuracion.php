<?php

namespace App;

//use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Configuracion extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = "configuracion";

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['id', 'mod_conf', 'ele_conf', 'des_conf', 'val_conf', 'est_conf'];

    public function ScopeModulo($query, $modulo)
    {
        if ($modulo) {
            return $query->where('mod_conf', 'ilike', "%$modulo%");
        }
    }

    public function ScopeDescripcion($query, $descripcion)
    {
        if ($descripcion) {
            return $query->where('des_conf', 'ilike', "%$descripcion%");
        }
    }
}
