<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campaña extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creacion de la tabla campañas
        Schema::create('CAMPANA', function (Blueprint $table) {
            $table->increments('CAMPANA_ID');
            $table->string('NOMBRE',60);        
            $table->date('INICIO');
            $table->date('FINALIZACION');            
            $table->boolean('ACTIVA');
            $table->string('TIPO');
            $table->enum('ESTADO',array('En Progreso','Completada','Abortada','Finalizada'));
            $table->integer('INGRESOS_ESP')->nullable()->default(0);
            $table->integer('PRESUPUESTO')->nullable()->default(0);
            $table->integer('COSTE')->nullable()->default(0);
            $table->string('RESPUESTA')->nullable();
            $table->text('DESCRIPCION')->nullable();            
            $table->timestamps();

            $table->index('NOMBRE');

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
        Schema::drop('CAMPANA');
    }
}
