<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearContacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // crear la tabla para los contactos
        Schema::create('CONTACTO',function ($tabla)
        {
           $tabla->increments('CONTACTO_ID');
           $tabla->string('TITULO',5);
           $tabla->string('NOMBRE',60);
           $tabla->string('APELLIDO',80);
           $tabla->string('TELEFONO',16)->nullable();
           $tabla->string('CELULAR',20)->nullable();
           $tabla->enum('TIPO',array('Particular','Gobierno','Empresa','Educacion'));
           $tabla->enum('ORIGEN',array('Anuncio','Folleto','Referencia de empleado',
            'Referencia de otro cliente','Sitio Web','Anuncio via email'));
           $tabla->boolean('AT_CORREO')->default(false);
           $tabla->string('EMPRESA')->nullable();
           $tabla->string('WEB')->nullable();
           $tabla->string('CORREO')->nullable();
           $tabla->enum('ESTADO',array('Contactado','Contactar a futuro',
            'Intento de contacto fallido','Iniciativa perdida','Sin contactar'));
           $tabla->enum('CALIFICACION', array('Adquirido','Activo','Mediano-Largo Plazo',
            'Proyecto Cancelado','Cerrado'));
           $tabla->enum('VALORACION',array('Caliente','Templado','Frio'));
           $tabla->integer('CAMPANA_ID')->nullable();
           $tabla->string('CALLE')->nullable();
           $tabla->string('NUM_EXT',6)->nullable();
           $tabla->string('COLONIA')->nullable();
           $tabla->string('CPOSTAL')->nullable();
           $tabla->text('DESCRIPCION')->nullable();
           $tabla->boolean('ESCLIENTE')->default(false);
           $tabla->timestamps();
           $tabla->index(array('CONTACTO_ID','NOMBRE','APELLIDO'));

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
        Schema::drop('CONTACTO');
    }
}
