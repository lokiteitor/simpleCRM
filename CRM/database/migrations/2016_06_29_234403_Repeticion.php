<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Repeticion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Crear tabla Repeticion
        Schema::create('REPETICION', function (Blueprint $table) {
            $table->increments('REPETICION_ID');
            $table->date('INICIO');
            $table->date('FIN');
            $table->integer('REPETIR_DIAS');
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
        //
        Schema::drop('REPETICION');

    }
}
