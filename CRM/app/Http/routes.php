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

Route::get("/ver/cuentas",function ()
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Lista de Cuentas";
   $data['titulo'] = "Cuentas";

   return view('listaCuentas', $data);
});

Route::get("/ver/oportunidades",function ()
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Lista de Oportunidades";
   $data['titulo'] = "Oportunidades";
   return view('listaOportunidades', $data);
});

Route::get("/ver/tareas",function ()
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Lista de Tareas";
   $data['titulo'] = "Tareas";
   return view('listaTareas', $data);
});

Route::get("/ver/eventos",function ()
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Calendario de eventos";
   $data['titulo'] = "eventos";
   return view('listaEventos', $data);
});


Route::get("/crear/contacto",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Contacto";
   $data['sitio'] = "Crear Contacto";
   $data['action'] = "/crear/cuenta/";
   $data['edicion'] = false;
   return view("crearContacto",$data);
});

Route::get("/crear/cliente",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Cliente";
   $data['sitio'] = "Crear Cliente";
   $data['edicion'] = false;
   $data['action'] = "/crear/cuenta/";
   return view("crearCliente",$data);
});

Route::get("/crear/cuenta",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Cuenta";
   $data['sitio'] = "Crear Cuenta";
   $data['action'] = "/crear/cuenta/";
   $data['edicion'] = false;
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
Route::get("/crear/campana",function ()
{
   $data['usuario'] = "Administrador";
   $data['titulo'] = "Crear Campaña";
   $data['sitio'] = "Crear Campaña";
   return view("crearCampana",$data);
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

Route::get("/editar/evento/{id}",function ($id)
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Editar Evento";
   $data['titulo'] = "Eventos";

   return view('crearEvento', $data);
});
Route::get("/editar/cliente/{id}",function ($id)
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Editar Cliente";
   $data['titulo'] = "Clientes";
   $data['edicion'] = true;
   $data['action'] = URL::to("/editar/cliente",array($id));

   return view('crearCliente', $data);
});

Route::get("/editar/contacto/{id}",function ($id)
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Editar Contacto";
   $data['titulo'] = "Contacto";
   $data['edicion'] = true;
   $data['action'] = URL::to("/editar/contacto",array($id));

   return view('crearContacto', $data);
});

Route::get("/editar/cuenta/{id}",function ($id)
{
   $data['usuario'] = "Administrador";
   $data['sitio'] = "Editar Cuenta";
   $data['titulo'] = "Editar";
   $data['edicion'] = true;
   $data['action'] = URL::to("/editar/cuenta",array($id));

   return view('crearCuenta', $data);
});

Route::post("/editar/cliente/{id}",function (Request $request,$id)
{
   # actualizar los datos y regresar al principio de la aplicacion
   return var_dump($request->all()) + var_dump($request->cookie('registros'));
});

Route::post("/editar/contacto/{id}",function (Request $request,$id)
{
   # actualizar los datos y regresar al principio de la aplicacion
   return var_dump($request->all()) + var_dump($request->cookie('registros'));
});

Route::post("/editar/cuenta/{id}",function (Request $request,$id)
{
   # actualizar los datos y regresar al principio de la aplicacion
   return var_dump($request->all()) + var_dump($request->cookie('registros'));
});

Route::get("/obtener/oportunidades",function ()
{
   // api para obtener los datos de las oportunidades
   $cuentas = array("empresa1","empresa2","empresa3");
   $fechas = array("21/02/2016","05/06/2008","30/04/2018");
   $titulo = array("titulo1","titulo2","titulo3");
   $tipo = array("tipo1","tipo2","tipo3");

   // generar combinacion de longintud entre 1 y 10
   $longintud = rand(1,20);
   $response = array();

   for ($i=0; $i < $longintud; $i++) {
      $mix = array("ncuenta" => $cuentas[rand(0,2)], 
         "fecha" => $fechas[rand(0,2)],"titulo"=> $titulo[rand(0,2)],
         "tipo" => $tipo[rand(0,2)]);
      array_push($response, $mix);
   }

   return response()->json($response);

});

Route::get("/obtener/tareas",function ()
{
   $cuentas = array("empresa1","empresa2","empresa3");
   $fechas = array("21/02/2016","05/06/2008","30/04/2018");
   $titulo = array("titulo1","titulo2","titulo3");
   $asunto = array("llamar al cliente","Entregar Cotizacion","Enviar Factura");
   $estado = array("Sin empezar","En progreso","Esperando");
   $prioridad = array("Muy alta","Alta","normal","Baja");

   $longintud = rand(1,20);
   $response = array();

   for ($i=0; $i < $longintud; $i++) {
      $mix = array("ncuenta" => $cuentas[rand(0,2)], 
         "fecha" => $fechas[rand(0,2)],"titulo"=> $titulo[rand(0,2)],
         "asunto" => $asunto[rand(0,2)], "estado" => $estado[rand(0,2)],
         "prioridad" => $prioridad[rand(0,3)]);
      array_push($response, $mix);
   }
   return response()->json($response);
});

Route::get("/obtener/eventos",function ()
{
   $titulo = array("titulo1","titulo2","titulo3");
   $asunto = array("llamar al cliente","Entregar Cotizacion","Enviar Factura");
   $ubicacion = array("Calle #123","Calle2 #456","Calle #1345");
   $tiempo = array("2016/06/24 12:30","2016/06/25 22:00","2016/06/02 08:00");
   $tiempofin = array("2016/06/24 12:30","2016/06/25 22:00","2016/06/02 08:00");
   $id = array("123455","454657","34547");
   $allday = array(true,false);

   $longintud = rand(1,20);
   $response = array();
   for ($i=0; $i < $longintud; $i++) {
      $mix = array("titulo" => $titulo[rand(0,2)], 
         "tiempo" => $tiempo[rand(0,2)],"tiempofin" => $tiempofin[rand(0,2)],
         "asunto"=> $asunto[rand(0,2)],"ubicacion" => $ubicacion[rand(0,2)],
         "id" => $id[rand(0,2)],"isallday" => $allday[rand(0,1)]);
      array_push($response, $mix);
   }
   return response()->json($response);

});

Route::get("/obtener/clientes",function ()
{
   $data = array("nombre" => "Sr. Raul Lopez","correo" => "correo@electronico.com",
      "Telefono" => "123-1234", "creacion" => "2016/05/25", "empresa" => "Vantec",
      "estado" => "Contactado","calificacion" => "Adquirido","origen" => "Folleto",
      "id" => rand(0,1023));

   $response = array();

   for ($i=0; $i < 10; $i++) {
      $data["id"] = rand(1,1023);
      array_push($response, $data);
   }
   return response()->json($response);   
});

Route::get("/obtener/contactos",function ()
{
   $data = array("nombre" => "Sr. Raul Lopez","correo" => "correo@electronico.com",
      "Telefono" => "123-1234", "creacion" => "2016/05/25", "empresa" => "Vantec",
      "estado" => "Contactado","calificacion" => "Adquirido","origen" => "Folleto",
      "id" => rand(0,1023));

   $response = array();

   for ($i=0; $i < 10; $i++) {
      $data["id"] = rand(1,1023);
      array_push($response, $data);
   }
   return response()->json($response);   
});


Route::get("/obtener/cuentas",function ()
{
   $data = array("nombre" => "Vantec","tipo" => "proveedor",
      "calificacion"=>"Adquirido","id" => rand(0,1023),"sector" => "Alimentos");

   $response = array();

   for ($i=0; $i < 10; $i++) {
      $data["id"] = rand(1,1023);
      array_push($response, $data);
   }
   return response()->json($response);   
});


Route::get("/obtener/cliente",function ()
{
   $response = array("sexo" => "sra","nombre" => "Luis","apellidos" => "Perez",
      "telefono" => "123-1235","celular"=>"444401285","origen"=>"Folleto",
      "atiende-correo"=>true,"empresa" => "Vantec","web"=>"www.vantec.mx",
      "estado"=>"Sin contactar","calificacion"=> "Cerrado","valoracion"=>"Frio",
      "calle"=>"Pensamiento","numero"=>"221","cpostal" =>"73999","descripcion"=>"Cliente de prueba");
   return response()->json($response);   
});

Route::get("/obtener/contacto",function ()
{
   $response = array("sexo" => "sra","nombre" => "Luis","apellidos" => "Perez",
      "telefono" => "123-1235","celular"=>"444401285","origen"=>"Folleto",
      "atiende-correo"=>true,"empresa" => "Vantec","web"=>"www.vantec.mx",
      "estado"=>"Sin contactar","calificacion"=> "Cerrado","valoracion"=>"Frio",
      "calle"=>"Pensamiento","numero"=>"221","cpostal" =>"73999","descripcion"=>"Cliente de prueba");
   return response()->json($response);   
});

Route::get("/obtener/cuenta",function ()
{
   $response = array("nombre" => "Vantec","tipo" => "proveedor",
      "calificacion"=>"Adquirido","id" => rand(0,1023),"sector" => "electronica",
      "telefono" => "123-3235","web" => "www.vantec.mx","Empleados" => 1,
      "calle"=>"Pensamiento","numero"=>"221","cpostal" =>"73999","descripcion"=>"Cuenta de prueba");
   return response()->json($response);   
});