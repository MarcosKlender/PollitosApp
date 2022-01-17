<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasculaConfiguracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bascula_configuracion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_bascula')->nullable();
            $table->string('nom_bascula');
            $table->string('ipx_bascula', 15);
            $table->string('est_bascula');
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
        Schema::dropIfExists('bascula_configuracion');
    }
}
