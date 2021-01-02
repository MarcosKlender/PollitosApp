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
            $table->integer('cant_pollos');
            $table->decimal('peso_gavetas_pollos');
            $table->decimal('peso_gavetas');
            $table->decimal('peso_final');
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
