<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('ruc_ci');
            $table->string('cliente');
            $table->string('placa');
            $table->string('conductor');
            $table->string('destino');
            $table->integer('cant_animales');
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
        Schema::dropIfExists('entregas');
    }
}
