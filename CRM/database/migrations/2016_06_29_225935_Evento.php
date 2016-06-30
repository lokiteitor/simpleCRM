<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Evento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Crear tabla Evento
        Schema::create('EVENTO', function (Blueprint $table) {
            $table->increments('EVENTO_ID');
            $table->integer('USUARIO_ID');
            $table->string('TITULO');
            $table->string('ASUNTO');
            $table->string('UBICACION');
            $table->dateTime('DE');
            $table->dateTime('A');
            $table->integer('CONTACTO_ID')->nullable();
            $table->text('PARTICIPANTES')->nullable();
            $table->integer('REPETICION_ID')->nullable();
            $table->integer('NOTIFICACION_ID')->nullable();
            $table->timestamps();
            $table->index('TITULO','ASUNTO');

            
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
        Schema::drop('EVENTO');
    }
}
