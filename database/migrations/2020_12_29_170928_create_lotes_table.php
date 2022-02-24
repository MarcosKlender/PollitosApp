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
            $table->integer('cantidad');
            $table->string('proveedor');
            $table->string('ruc_ci', 13)->nullable();
            $table->string('procedencia');
            $table->string('placa');
            $table->string('conductor');
            $table->string('usuario_creacion');
            $table->string('usuario_modificacion')->nullable();;
            $table->string('anulado', 1);
            $table->string('liquidado', 1);
            $table->string('visceras', 1);
            $table->string('estado_egresos', 1);
            $table->string('observaciones')->nullable();
            $table->integer('cant_ahogados')->nullable();
            $table->integer('peso_ahogados')->nullable();
            //$table->integer('cant_ahogados_egresos')->nullable();
            //$table->integer('peso_ahogados_egresos')->nullable();
            //$table->integer('cant_gvacia_ahogados_egresos')->nullable();
            //$table->integer('cant_estropeados_egresos')->nullable();
            //$table->integer('peso_estropeados_egresos')->nullable();
            //$table->integer('cant_gvacia_estropeados_egresos')->nullable();
            //$table->integer('cant_mollejas_egresos')->nullable();
            //$table->integer('peso_mollejas_egresos')->nullable();
            //$table->integer('cant_gvacia_mollejas_egresos')->nullable();
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
