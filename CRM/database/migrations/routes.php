<?php

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


Route::get('/installer',function ()
{


        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
        Schema::create('CONTACTO',function ($tabla)
        {
           $tabla->increments('CONTACTO_ID');
           $tabla->string('TITULO',5);
           $tabla->string('NOMBRE',60);
           $tabla->string('APELLIDO',80);
           $tabla->string('TELEFONO',16)->nullable();
           $tabla->string('CELULAR',20)->nullable();
           $tabla->string('TIPO');
           $tabla->string('ORIGEN');
           $tabla->boolean('AT_CORREO')->default(false);
           $tabla->string('EMPRESA')->nullable();
           $tabla->string('WEB')->nullable();
           $tabla->string('CORREO')->nullable();
           $tabla->string('ESTADO');            
           $tabla->string('CALIFICACION');
           $tabla->string('VALORACION');
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
        Schema::create('OPORTUNIDAD', function (Blueprint $table) {
            $table->increments('OPORTUNIDAD_ID');
            $table->string('TITULO');
            $table->integer('USUARIO_ID');
            $table->integer('CONTACTO_ID');
            $table->integer('CAMPANA_ID')->nullable();
            $table->string('TIPO');
            $table->boolean('PRESUPUESTO')->default(false);
            $table->float('INVERSION')->default(0.00);
            $table->string('ETAPA');            
            $table->integer('PROBABILIDAD')->nullable();
            $table->integer('FACTURA')->nullable();
            $table->float('IMPORTE')->nullable();
            $table->date('CIERRE');
            $table->text('INFORMACION')->nullable();
            $table->timestamps();

            $table->index(array('FACTURA','TITULO'));
            

        });    
        Schema::create('TAREA', function (Blueprint $table) {
            $table->increments('TAREA_ID');
            $table->integer('USUARIO_ID');
            $table->string('TITULO',256);
            $table->string('ASUNTO',256);
            $table->date('VENCIMIENTO');
            $table->integer('CONTACTO_ID');
            $table->string('ESTADO');
            $table->string('PRIORIDAD');
            $table->boolean('NOTIFICACION');
            $table->text('DESCRIPCION')->nullable();
            // recordatorio
            $table->boolean('RECORDAR')->default(false);
            $table->dateTime('FECHA_RECORDAR')->nullable();
            // repeticion
            $table->boolean('REPETIR')->default(false);
            $table->date('REPETIR_INICIO')->nullable();
            $table->date('REPETIR_FIN')->nullable();
            $table->integer('REPETIR_DIAS')->nullable();
            // 
            $table->timestamps();
            //$table->index(array('TITULO','ASUNTO'));
        });         
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

});

?>