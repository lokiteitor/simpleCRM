<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Evento;
    use App\Recordatorio;
    use App\Repeticion;        
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    /**
    * Controlador para la seccion de Eventos
    */
    class EventosController extends Controller
    {

        public function listarEventos()
        {
           $data['usuario'] = "Administrador";
           $data['sitio'] = "Lista de Eventos";
           $data['titulo'] = "Eventos";
           return view('listaEventos', $data);            
        }

        public function crearEvento()
        {
            $data['usuario'] = "Administrador";
            $data['sitio'] = "Crear Evento";
            $data['titulo'] = "Eventos";
            $data['edicion'] = false;
            return view("crearEvento",$data);
        }

        public function subirEvento(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
            // reglas de validacion
            $reglas = array(
                    'nombre' => 'required',
                    'asunto' => 'required',
                    'fecha' => 'required|date_format:Y-m-d',
                    'defecha' => 'required_unless:allday,on,date_format:H:i:s',
                    'afecha' => 'required_unless:allday,on,date_format:H:i:s',
                    'otro' => 'required_if:relacionado,Otro',                    
                    'inicio' => 'required_if:repetir,on|date_format:Y-m-d',
                    'finalizacion' => 'required_if:repetir,on|date_format:Y-m-d',
                    'repetira' => 'required_if:repetir,on',
                    'otrorepeticion' => 'required_if:repetir,on|integer|required_if:repetira,Otro',             
                );

            $mensajes = array(
                'required' => 'Este campo es requerido',
                'required_unless' => 'Solo una opcion puede ser activada',
                'regex' => 'El campo debe seguir el formato establecido',
                'required_with' => 'Los demas campos deben de estar señalados',
                'data_format' => 'La fecha debe estar en el campo prestablecido',
                'required_if' => 'Los demas campos deben de ser señalados',
                'integer' => 'El campo debe ser un entero'
                );

            $validador = Validator::make($data,$reglas,$mensajes);

            if ($validador->passes()) {
                //  guardar en la base de datos
                $evento = new Evento;
                $evento->TITULO = $request->input('nombre');

                // TODO : insertar el id del usuario actual
                $evento->USUARIO_ID = 1;

                $evento->ASUNTO = $request->input('asunto');
                if ($request->exists('ubicacion')) {
                    $evento->CONTACTO_ID = $request->input('buscar-contacto');
                }
                $evento->FECHA = $request->input('fecha');
                if ($request->input('allday') == 'on') {
                    $evento->DE = '00:00:00';
                    $evento->A = '23:59:00';
                }
                else{
                    $evento->DE = $request->input('defecha');
                    $evento->A = $request->input('afecha');
                }
                if ($request->exists('buscar-contacto')) {
                    $evento->CONTACTO_ID = $request->input('buscar-contacto');
                }
                if ($request->exists('participantes')) {
                    $evento->PARTICIPANTES = $request->input('participantes');
                }                
                if ($request->exists('descripcion')) {
                    $evento->DESCRIPCION = $request->input('descripcion');
                }

                $evento->save();
                // crear el registro del recordatorio y notificacion y ligarlos 
                // a las claves foraneas en evento
                if ($request->input('recordatorio') == 'on') {
                    

                    $recordatorio = new Recordatorio;
                    $recordatorio->DIAS = $request->input('recordar');
                    $recordatorio->HORA = $request->input('horaRecord');
                    $recordatorio->save();
                    $evento->RECORDAR = true;
                    $evento->RECORDATORIO_ID =  $recordatorio->RECORDATORIO_ID;
                    $evento->save();
                }
                if ($request->input('repetir') == 'on') {
                    $evento->REPETIR = true;

                    $repeticion = new Repeticion;
                    $repeticion->INICIO = $request->input('inicio');
                    $repeticion->FIN = $request->input('finalizacion');
                    if ($request->input('repetira') == 'Otro') {
                        $repeticion->REPETIR_DIAS = $request->input('otrorepeticion');
                    }
                    else{
                        $repeticion->REPETIR_DIAS = $request->input('repetira');
                    }
                    $repeticion->save();
                    $evento->REPETICION_ID =  $repeticion->REPETICION_ID;
                    $evento->save();
                }
            }
            return redirect('/crear/evento')->withErrors($validador)->withInput();
        }
    }
 ?>