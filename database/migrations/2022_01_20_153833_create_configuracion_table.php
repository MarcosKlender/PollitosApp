<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            $table->string("mod_conf")->nullable();
            $table->string("des_conf")->nullable();
            $table->string("aut_conf")->nullable();
            $table->string("ele_conf")->nullable();
            $table->string("val_conf")->nullable();
            $table->string("val2_conf")->nullable();
            $table->string("est_conf", 1);
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
        Schema::dropIfExists('configuracion');
    }
}
