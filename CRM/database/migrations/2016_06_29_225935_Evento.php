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
            $table->time('DE');
            $table->time('A');
            $table->boolean('ALLDAY')->default(false);
            $table->integer('CONTACTO_ID')->nullable();
            $table->text('PARTICIPANTES')->nullable();
            // recordatorio
            $table->boolean('RECORDAR')->default(false);
            $table->dateTime('FECHA_RECORDAR')->nullable();
            // repeticion
            $table->boolean('REPETIR')->default(false);
            $table->date('REPETIR_INICIO')->nullable();
            $table->date('REPETIR_FIN')->nullable();
            $table->integer('REPETIR_DIAS')->nullable();
            // 
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
