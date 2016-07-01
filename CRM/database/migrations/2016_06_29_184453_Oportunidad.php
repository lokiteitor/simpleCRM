<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Oportunidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //crear tabla de oportunidadaes
        Schema::create('OPORTUNIDAD', function (Blueprint $table) {
            $table->increments('OPORTUNIDAD_ID');
            $table->string('TITULO');
            $table->integer('USUARIO_ID');
            $table->integer('CONTACTO_ID');
            $table->integer('CAMPANA_ID')->nullable();
            $table->enum('TIPO',array('Negocio Nuevo','Negocio Existe'));
            $table->boolean('PRESUPUESTO')->default(false);
            $table->enum('ETAPA',array('Calificacion','Necesita analisis','Propuesta',
                'Negocioando','Completada','Perdida'))->nullable();
            $table->integer('PROBABILIDAD')->nullable();
            $table->integer('FACTURA')->nullable();
            $table->integer('IMPORTE')->nullable();
            $table->date('CIERRE');
            $table->text('INFORMACION')->nullable();
            $table->timestamps();

            $table->index(array('FACTURA','TITULO'));
            

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
        Schema::drop('OPORTUNIDAD');
    }
}
