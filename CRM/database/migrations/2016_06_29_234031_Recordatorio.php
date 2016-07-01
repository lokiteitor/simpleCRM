<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Recordatorio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Crear tabla recordatorio
        Schema::create('RECORDATORIO', function (Blueprint $table) {
            $table->increments('RECORDATORIO_ID');
            $table->integer('DIAS');
            $table->time('HORA');
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
        Schema::drop('RECORDATORIO');
    }
}
