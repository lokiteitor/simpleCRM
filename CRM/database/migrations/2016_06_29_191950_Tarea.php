<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tarea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Crear Tabla tareas
        Schema::create('TAREA', function (Blueprint $table) {
            $table->increments('TAREA_ID');
            $table->integer('USUARIO_ID');
            $table->string('TITULO');
            $table->string('ASUNTO')->nullable();
            $table->date('VENCIMIENTO');
            $table->integer('ID_CONTACTO');
            $table->enum('ESTADO',array('Sin Empezar','Diferido','En Progreso','Completada','Esperando'));
            $table->enum('PRIORIDAD',array('Muy Alta','Alta','Normal','Baja','Muy Baja'));
            $table->boolean('NOTIFICACION');
            $table->text('DESCRIPCION')->nullable();
            $table->integer('RECORDATORIO_ID')->nullable();
            $table->integer('REPETICION_ID')->nullable();           
            $table->timestamps();

            $table->index(array('TITULO','ASUNTO'));
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
        Schema::drop('TAREA');
    }
}
