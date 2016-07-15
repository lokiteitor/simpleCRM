<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Contacto::class, function (Faker\Generator $faker) {
    return [
        'TITULO' => $faker->randomElement($array = array('Sr.','Sra.','Dr.','Ing.','Lic.','Arq.','Prof.')),
        'NOMBRE' => $faker->name,
        'APELLIDO' => $faker->lastName,
        'TELEFONO' => $faker->phoneNumber, 
        'CELULAR' => $faker->phoneNumber,
        'TIPO' => $faker->randomElement($array = array('Particular','Gobierno','Empresa','Educacion')),
        'ORIGEN' => $faker->randomElement($array = array('Anuncio','Folleto','Referencia de empleado',
            'Referencia de otro cliente','Sitio Web','Anuncio via email')),
        'AT_CORREO' => $faker->boolean($chanceOfGettingTrue = 80) ,
        'EMPRESA'  => $faker->company,
        'WEB' => $faker->domainName,
        'CORREO' => $faker->email,
        'ESTADO' => $faker->randomElement($array = array('Contactado','Contactar a futuro',
            'Intento de contacto fallido','Iniciativa perdida','Sin contactar')),
        'CALIFICACION' => $faker->randomElement($array = array('Adquirido','Activo','Mediano-Largo Plazo',
            'Proyecto Cancelado','Cerrado')),
        'VALORACION' => $faker->randomElement($array = array('Caliente','Templado','Frio')),
        'CAMPANA_ID' => $faker->numberBetween($min = 0, $max = 50),
        'CALLE'=> $faker->streetName,
        'NUM_EXT' => $faker->buildingNumber,
        'COLONIA'=> $faker->streetSuffix,
        'CPOSTAL'=> $faker->postcode,
        'DESCRIPCION' => $faker->text($maxNbChars = 60),
        'ESCLIENTE' => $faker->boolean($chanceOfGettingTrue = 80)
    ];
});

$factory->define(App\Campana::class, function (Faker\Generator $faker) {
    return [
        'NOMBRE' => $faker->catchPhrase,
        'INICIO' => date('Y-m-d',time() + (rand(-31,62) * 24 * 60 * 60)),
        'FINALIZACION' => date('Y-m-d',time() + (rand(-31,62) * 24 * 60 * 60)),
        'ACTIVA' => $faker->boolean($chanceOfGettingTrue = 60),
        'TIPO' => $faker->randomElement(array('Email','Referencia','Busqueda','Social Media','Otro')),
        'ESTADO' => $faker->randomElement(array('En Progreso','Completada','Abortada','Planeando')),
        'INGRESOS_ESP' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 2000),
        'PRESUPUESTO' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 2000),
        'COSTE' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 2000),
        'RESPUESTA' => $faker->word,
        'DESCRIPCION' => $faker->text($maxNbChars = 60)
    ];
});

$factory->define(App\Oportunidad::class, function (Faker\Generator $faker) {
    return [
        'TITULO' => $faker->catchPhrase,
        'USUARIO_ID' => $faker->numberBetween(1,4),
        'CONTACTO_ID' => $faker->numberBetween(1,50),
        'CAMPANA_ID' => $faker->numberBetween(1,50),
        'TIPO' => $faker->randomElement(array('Negocio Nuevo','Negocio Existente')),
        'PRESUPUESTO' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 2000),
        'ETAPA' => $faker->randomElement(array('Calificacion','Necesita Analisis','Propuesta',
                'Negociando','Completada','Perdida')),
        'PROBABILIDAD' => $faker->numberBetween(0,100),
        'FACTURA' => $faker->numberBetween(30000,500400),
        'IMPORTE' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 2000),
        'INVERSION' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 2000),
        'CIERRE' => date('Y-m-d',time() + (rand(-31,62) * 24 * 60 * 60)),
        'INFORMACION' => $faker->text(60),
    ];
});

$factory->define(App\Tarea::class, function (Faker\Generator $faker) {
    return [
        'USUARIO_ID' => $faker->numberBetween(1,4),
        'TITULO' => $faker->catchPhrase,
        'ASUNTO' => $faker->sentence(),
        'VENCIMIENTO' => date('Y-m-d',time() + (rand(-31,62) * 24 * 60 * 60)),
        'CONTACTO_ID' => $faker->numberBetween(1,50),
        'ESTADO' => $faker->randomElement(array('Sin Empezar','Diferido','En Progreso','Completada','Esperando')),
        'PRIORIDAD' => $faker->randomElement(array('Muy Alta','Alta','Normal','Baja','Muy Baja')),
        'NOTIFICACION' => $faker->boolean(90),
        'DESCRIPCION' => $faker->text(60),
        'RECORDAR' => $faker->boolean(90),
        'FECHA_RECORDAR' => date('Y-m-d H:i:s',time() + (rand(-3,3) * rand(1,24) * 60 * 60)),
        'REPETIR' => $faker->boolean(20),
        'REPETIR_INICIO' => date('Y-m-d',time() + (rand(-31,62) * 24 * 60 * 60)),
        'REPETIR_FIN' => date('Y-m-d',time() + (rand(-31,62) * 24 * 60 * 60)),
        'REPETIR_DIAS' => $faker->randomElement(array(1,7,31,365,rand(1,15)))

    ];
});


$factory->define(App\Evento::class, function (Faker\Generator $faker) {
    return [
        'USUARIO_ID' => $faker->numberBetween(1,4),
        'TITULO' => $faker->catchPhrase,
        'ASUNTO' => $faker->sentence(),
        'FECHA' => date('Y-m-d',time() + (rand(-31,62) * 24 * 60 * 60)),
        'UBICACION' => $faker->streetAddress,
        'DE' => $faker->time(),
        'A' => $faker->time(),
        'ALLDAY' => $faker->boolean(20),
        'CONTACTO_ID' => $faker->numberBetween(1,50),
        'PARTICIPANTES' => $faker->name,     
        'DESCRIPCION' => $faker->text(60),
        'RECORDAR' => $faker->boolean(90),
        'FECHA_RECORDAR' => date('Y-m-d H:i:s',time() + (rand(-3,3) * rand(1,24) * 60 * 60)),
        'REPETIR' => $faker->boolean(20),
        'REPETIR_INICIO' => date('Y-m-d',time() + (rand(-31,62) * 24 * 60 * 60)),
        'REPETIR_FIN' => date('Y-m-d',time() + (rand(-31,62) * 24 * 60 * 60)),
        'REPETIR_DIAS' => $faker->randomElement(array(1,7,31,365,rand(1,15)))
    ];
});


