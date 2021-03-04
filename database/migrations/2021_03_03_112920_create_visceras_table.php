<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViscerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visceras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lotes_id');
            $table->string('tipo');
            $table->decimal('peso_bruto');
            $table->decimal('peso_gavetas')->nullable();
            $table->decimal('peso_final')->nullable();
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
        Schema::dropIfExists('visceras');
    }
}
