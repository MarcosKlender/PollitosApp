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
            $table->string('placa')->nullable();
            $table->string('conductor')->nullable();
            $table->string('destino')->nullable();
            $table->integer('cant_animales')->nullable();
            $table->string('usuario_creacion');
            $table->string('usuario_modificacion')->nullable();;
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
