<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// secciones especiales
Route::get('/engine/buscador',[
    'uses' => 'APIController@buscador',
    'middleware' => 'auth',
    ]);

// index
Route::get('/',function ()
{
    $data['usuario'] = 'Administrador';
    return view('index',$data);
});

// seccion de prospectos
Route::get('/ver/prospectos ',[
    'uses' =>'ProspectosController@listarProspectos',
    'middleware' => 'auth',
    ]);

Route::get('/crear/prospecto',[
    'uses' => 'ProspectosController@crearProspecto',
    'middleware' => 'auth']);

Route::post('/crear/prospecto',[
    'uses' => 'ProspectosController@subirProspecto',
    'middleware' => 'auth']);

// seccion de clientes
Route::get('/ver/clientes ',[
    'uses' => 'ClientesController@listarClientes',
    'middleware' => 'auth'
    ]);

Route::get('/crear/cliente',[
    'uses' => 'ClientesController@crearCliente',
    'middleware' => 'auth'
    ]);

Route::post('/crear/cliente',[
    'uses' => 'ClientesController@subirCliente',
    'middleware' => 'auth'
    ]);

// seccion de campañas
Route::get('/ver/campanas ',[
    'uses' =>  'CampanasController@listarCampanas',
    'middleware' => 'auth'
    ]);

Route::get('/crear/campana',[
    'uses' => 'CampanasController@crearCampana',
    'middleware' => 'auth'
    ]);

Route::post('/crear/campana',[
    'uses' => 'CampanasController@subirCampana',
    'middleware' => 'auth'
    ]);

// seccion de oportunidades
Route::get('/ver/oportunidades ',[
    'uses' =>  'OportunidadesController@listarOportunidades',
    'middleware' => 'auth'
    ]);

Route::get('/crear/oportunidad',[
    'uses' => 'OportunidadesController@crearOportunidad',
    'middleware' => 'auth'
    ]);

Route::post('/crear/oportunidad',[
    'uses' => 'OportunidadesController@subirOportunidad',
    'middleware' => 'auth'
    ]);

// seccion de tareas
Route::get('/ver/tareas ',[
    'uses' =>  'TareasController@listarTareas',
    'middleware' => 'auth'
    ]);

Route::get('/crear/tarea',[
    'uses' => 'TareasController@crearTarea',
    'middleware' => 'auth'
    ]);

Route::post('/crear/tarea',[
    'uses' => 'TareasController@subirTarea',
    'middleware' => 'auth'
    ]);

// seccion de eventos
Route::get('/ver/eventos ',[
    'uses' =>  'EventosController@listarEventos',
    'middleware' => 'auth'
    ]);

Route::get('/crear/evento',[
    'uses' => 'EventosController@crearEvento',
    'middleware' => 'auth'
    ]);

Route::post('/crear/evento',[
    'uses' => 'EventosController@subirEvento',
    'middleware' => 'auth'
    ]);


// rutas para obtener datos via ajax

Route::get('/obtener/contactos',[
    'uses' => "APIController@contactos",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/clientes',[
    'uses' => "APIController@clientes",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/campanas',[
    'uses' => "APIController@campanas",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/oportunidades',[
    'uses' => "APIController@oportunidades",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/tareas',[
    'uses' => "APIController@tareas",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/eventos',[
    'uses' => "APIController@eventos",
    'middleware' => 'auth'
    ]);

// secciones para la edicion de clientes

Route::get('/editar/prospecto/{id}',[
    'uses' => "ProspectosController@editarProspecto",
    'middleware' => 'auth'
    ]);

Route::get('/editar/cliente/{id}',[
    'uses' => "ClientesController@editarCliente",
    'middleware' => 'auth'
    ]);

Route::get('/editar/campana/{id}',[
    'uses' => "CampanasController@editarCampana",
    'middleware' => 'auth'
    ]);

Route::get('/editar/oportunidad/{id}',[
    'uses' => "OportunidadesController@editarOportunidad",
    'middleware' => 'auth'
    ]);

Route::get('/editar/tarea/{id}',[
    'uses' => "TareasController@editarTarea",
    'middleware' => 'auth'
    ]);

Route::get('/editar/evento/{id}',[
    'uses' => "EventosController@editarEvento",
    'middleware' => 'auth'
    ]);

// obtencion de datos de objetos de forma unitaria
Route::get('/obtener/prospecto/',[
    'uses' => "ProspectosController@obtenerProspecto",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/cliente/',[
    'uses' => "ClientesController@obtenerCliente",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/campana/',[
    'uses' => "CampanasController@obtenerCampana",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/oportunidad/',[
    'uses' => "OportunidadesController@obtenerOportunidad",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/tarea/',[
    'uses' => "TareasController@obtenerTarea",
    'middleware' => 'auth'
    ]);

Route::get('/obtener/evento/',[
    'uses' => "EventosController@obtenerEvento",
    'middleware' => 'auth'
    ]);

// rutas para la vista detalles

Route::get('/detalles/prospecto/{id}',[
    'uses' => "ProspectosController@detallesProspecto",
    'middleware' => 'auth'
    ]);

Route::get('/detalles/cliente/{id}',[
    'uses' => "ClientesController@detallesCliente",
    'middleware' => 'auth'
    ]);

Route::get('/detalles/campana/{id}',[
    'uses' => "CampanasController@detallesCampana",
    'middleware' => 'auth'
    ]);

// ruta unica que maneja los componentes de la vista detalles

Route::get('/obtener/detalles',[
    'uses' => "APIController@detalles",
    'middleware' => 'auth'
    ]);


// rutas informes

Route::get('/ver/informes',[
    'uses' => 'InformesController@listado',
    'middleware' => 'auth'
    ]);

Route::get('/ver/informe/{clasificacion}/{tipo}',[
    'uses' => 'InformesController@generarInforme',
    'middleware' => 'auth'
    ]);

Route::get('/obtener/datos/informes',[
    'uses' => 'InformesController@obtenerDatos',
    'middleware' => 'auth'
    ]);


// Authentication routes...
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', function ()
{
    Auth::logout();
    return redirect('/auth/login');
});

// Registration routes...
Route::get('/auth/registro',[
    'uses' =>  'Auth\AuthController@getRegister',
    
    ]);

Route::post('/auth/registro',[
    'uses' =>  'Auth\AuthController@postRegister',
    
    ]);

// password reset

Route::get('/password/recuperar',[
    'uses' => 'Auth\PasswordController@getEmail'
    ]);

Route::post('/password/email',[
    'uses' => 'Auth\PasswordController@postEmail'
    ]);

Route::get('/password/reset/{token}',[
    'uses' => 'Auth\PasswordController@getReset'

    ]);

Route::post('/password/reset',[
    'uses' => 'Auth\PasswordController@postReset'
    ]);


?>
