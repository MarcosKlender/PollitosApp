<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lotes_id');
            $table->integer('cant_gavetas');
            $table->decimal('peso_bruto');
            $table->decimal('peso_gavetas')->nullable();
            $table->decimal('peso_final')->nullable();
            $table->string('tipo_peso', 2);
            $table->string('usuario_creacion');
            $table->string('usuario_modificacion')->nullable();;
            $table->string('liquidado', 1)->nullable();
            $table->string('anulado', 1);
            $table->string('observaciones')->nullable();
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
        Schema::dropIfExists('egresos');
    }
}
