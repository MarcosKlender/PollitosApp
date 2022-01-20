<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basculas extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'bascula';

    public $timestamps = false;

    protected $primaryKey = 'id';

   // public $incrementing = false;

    protected $fillable = [ 'id', 'cod_bascula', 'ipx_bascula','nom_user','tipo_peso','automatico', 'nom_menu'];


} 