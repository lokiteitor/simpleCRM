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
            $table->string('UBICACION')->nullable();
            $table->date('FECHA');
            $table->dateTime('DE');
            $table->dateTime('A');
            $table->integer('CONTACTO_ID')->nullable();
            $table->text('PARTICIPANTES')->nullable();
            $table->boolean('RECORDAR')->default(false);
            $table->boolean('REPETIR')->default(false);            
            $table->integer('REPETICION_ID')->nullable();
            $table->integer('RECORDATORIO_ID')->nullable();
            $table->text('DESCRIPCION');
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
