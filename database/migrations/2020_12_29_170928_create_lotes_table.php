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
            $table->integer('cant_animales_egresos')->nullable();
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
