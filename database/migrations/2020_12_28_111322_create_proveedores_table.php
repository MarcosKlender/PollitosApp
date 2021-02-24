<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 3);
            $table->string('ruc_ci', 13)->unique();
            $table->string('nombres');
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('telefono', 10);
            $table->string('movil', 10);
            $table->string('email');
            $table->string('provincia');
            $table->string('ciudad');
            $table->string('parroquia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
