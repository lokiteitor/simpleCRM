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

Route::get('/ver/prospectos ', 'ProspectosController@listarProspectos');

Route::get('/crear/prospecto','ProspectosController@crearProspecto');

Route::post('/crear/prospecto','ProspectosController@subirProspecto');


?>