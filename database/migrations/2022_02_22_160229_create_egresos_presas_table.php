<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresosPresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos_presas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lotes_id');
            $table->integer("cant_ahogados_egresos");
            $table->decimal("peso_ahogados_egresos");
            $table->integer("cant_gvacia_ahogados_egresos");
            $table->decimal("peso_gvacia_ahogados_egresos")->nullable();
            $table->integer("cant_estropeados_egresos");
            $table->decimal("peso_estropeados_egresos");
            $table->integer("cant_gvacia_estropeados_egresos");
            $table->decimal("peso_gvacia_estropeados_egresos")->nullable();;
            $table->decimal("peso_mollejas_egresos");
            $table->integer("cant_gvacia_mollejas_egresos")->nullable();;
            $table->decimal("peso_gvacia_mollejas_egresos");
            $table->string("usuario_creacion");
            $table->string("usuario_modificacion")->nullable();
            $table->string("estado_egreso_presas",1);
            $table->timestamps();
            $table->foreign('lotes_id')->references('id')->on('lotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('egresos_presas');
    }
}
