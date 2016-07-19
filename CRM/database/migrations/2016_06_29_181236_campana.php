<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campana extends Migration
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
            $table->string('NOMBRE',128);        
            $table->date('INICIO');
            $table->date('FINALIZACION');            
            $table->boolean('ACTIVA')->default(false);
            $table->string('TIPO');
            $table->string('ESTADO');
            $table->float('INGRESOS_ESP')->nullable()->default(0);
            $table->float('PRESUPUESTO')->nullable()->default(0);
            $table->float('COSTE')->nullable()->default(0);
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
