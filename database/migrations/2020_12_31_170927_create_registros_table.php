<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lotes_id');
            $table->integer('cant_gavetas');
            $table->integer('cant_pollos')->nullable();
            $table->decimal('peso_bruto');
            $table->decimal('peso_gavetas')->nullable();
            $table->decimal('peso_final')->nullable();
            $table->string('usuario');
            $table->string('anulado', 1);
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
        Schema::dropIfExists('registros');
    }
}
