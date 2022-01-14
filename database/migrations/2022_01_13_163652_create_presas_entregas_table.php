<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresasEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presas_entregas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entregas_id');
            $table->string('tipo_entrega');
            $table->integer('cant_gavetas');
            $table->string('tipo_peso', 2)->nullable();
            $table->decimal('peso_bruto');
            $table->string('usuario');
            $table->string('anulado', 1);
            $table->string('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('entregas_id')->references('id')->on('entregas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presas_entregas');
    }
}
