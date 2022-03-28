<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoEntregaToEntregas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entregas', function (Blueprint $table) {
            $table->string('tipo_entrega', 1)->nullable()->before('observaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entregas', function (Blueprint $table) {
            //
        });
    }
}
