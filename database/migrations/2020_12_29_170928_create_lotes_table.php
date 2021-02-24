<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('proveedor');
            $table->string('ruc_ci', 13)->nullable();
            $table->string('procedencia');
            $table->string('placa');
            $table->string('conductor');
            $table->string('usuario');
            $table->string('anulado', 1);
            $table->string('liquidado', 1);
            $table->string('observaciones')->nullable();
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
        Schema::dropIfExists('lotes');
    }
}
