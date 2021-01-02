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
            $table->string('proveedor');
            $table->string('procedencia');
            $table->string('placa');
            $table->string('conductor');
            // $table->string('cant_gavetas')->nullable();
            // $table->string('cant_pollos')->nullable();
            // $table->decimal('peso_gavetas_pollos')->nullable();
            // $table->decimal('peso_gavetas')->nullable();
            // $table->decimal('peso_final')->nullable();
            $table->string('usuario');
            $table->string('anulado', 1);
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
