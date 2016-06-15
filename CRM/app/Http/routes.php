<?php

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
Route::get("/",function ()
{
    $data['titulo'] = "Login";
    return view('login', $data);
});

Route::get("/usuario",function(){

    $data['titulo'] = 'Inicio';
    $data['usuario'] = 'usuario';

    return view("index",$data);
});

Route::get("/ver/clientes",function ()
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Lista de clientes";
   $data['titulo'] = "Clientes";

   return view('listaClientes', $data);
});


Route::get("/ver/contactos",function ()
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Lista de contactos";
   $data['titulo'] = "Contactos";

   return view('listaContactos', $data);
});

Route::get("/crear/contacto",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Contacto";
   $data['sitio'] = "Crear Contacto";
   return view("crearContacto",$data);
});

Route::get("/crear/cliente",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Cliente";
   $data['sitio'] = "Crear Cliente";
   return view("crearCliente",$data);
});

Route::get("/crear/cuenta",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Cuenta";
   $data['sitio'] = "Crear Cuenta";
   return view("crearCuenta",$data);
});

Route::get("/crear/oportunidad",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Oportunidad";
   $data['sitio'] = "Crear Oportunidad";
   return view("crearOportunidad",$data);
});

Route::get("/crear/tarea",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Tarea";
   $data['sitio'] = "Crear Tarea";
   return view("crearTarea",$data);
});

Route::get("/crear/evento",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Evento";
   $data['sitio'] = "Crear Evento";
   return view("crearEvento",$data);
});


Route::get("/detalles/cliente",function ()
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Detalles del cliente";
   $data['titulo'] = "Clientes";

   return view('detalleCliente', $data);
});

Route::get("/detalles/contacto",function ()
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Detalles del Contacto";
   $data['titulo'] = "Contacto";

   return view('detalleContacto', $data);
});