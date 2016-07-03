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

// seccion de prospectos
Route::get('/ver/prospectos ', 'ProspectosController@listarProspectos');

Route::get('/crear/prospecto','ProspectosController@crearProspecto');

Route::post('/crear/prospecto','ProspectosController@subirProspecto');

// seccion de clientes
Route::get('/ver/clientes ', 'ClientesController@listarClientes');

Route::get('/crear/cliente','ClientesController@crearCliente');

Route::post('/crear/cliente','ClientesController@subirCliente');

// seccion de campañas
Route::get('/ver/campanas ', 'CampanasController@listarCampanas');

Route::get('/crear/campana','CampanasController@crearCampana');

Route::post('/crear/campana','CampanasController@subirCampana');

// seccion de oportunidades
Route::get('/ver/oportunidades ', 'OportunidadesController@listarOportunidades');

Route::get('/crear/oportunidad','OportunidadesController@crearOportunidad');

Route::post('/crear/oportunidad','OportunidadesController@subirOportunidad');

// seccion de tareas
Route::get('/ver/tareas ', 'TareasController@listarTareas');

Route::get('/crear/tarea','TareasController@crearTarea');

Route::post('/crear/tarea','TareasController@subirTarea');

// seccion de eventos
Route::get('/ver/eventos ', 'EventosController@listarEventos');

Route::get('/crear/evento','EventosController@crearEvento');

Route::post('/crear/evento','EventosController@subirEvento');


// rutas para obtener datos via ajax

Route::get('/obtener/contactos',"APIController@contactos");

Route::get('/obtener/clientes',"APIController@clientes");

Route::get('/obtener/campanas',"APIController@campanas");

Route::get('/obtener/oportunidades',"APIController@oportunidades");

Route::get('/obtener/tareas',"APIController@tareas");

Route::get('/obtener/eventos',"APIController@eventos");

// secciones para la edicion de clientes

Route::get('/editar/prospecto/{id}',"ProspectosController@editarProspecto");

Route::get('/editar/cliente/{id}',"ClientesController@editarCliente");

// obtencion de datos de objetos de forma unitaria
Route::get('/obtener/prospecto/',"ProspectosController@obtenerProspecto");

Route::get('/obtener/cliente/',"ClientesController@obtenerCliente");

?>