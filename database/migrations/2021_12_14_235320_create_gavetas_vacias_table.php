<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGavetasVaciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gavetas_vacias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lotes_id');
            $table->integer('cant_gavetas_vacias');
            $table->decimal('peso_gavetas_vacias');
            $table->decimal('peso_final_gavetas')->nullable();
            $table->string('tipo_peso', 2)->nullable();
            $table->string('usuario');
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
        Schema::dropIfExists('gavetas_vacias');
    }
}
