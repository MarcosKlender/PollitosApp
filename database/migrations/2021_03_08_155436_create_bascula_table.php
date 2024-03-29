<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bascula', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_bascula');
            $table->string('nom_user');
            $table->string('ipx_bascula')->nullable();
            $table->string('tipo_peso', 2);
            $table->string('automatico', 1);
            $table->string('nom_menu');
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
        Schema::dropIfExists('bascula');
    }
}
