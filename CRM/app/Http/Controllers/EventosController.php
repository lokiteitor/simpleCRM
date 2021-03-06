<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Evento;
    use App\Contacto;      
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;

    /**
    * Controlador para la seccion de Eventos
    */
    class EventosController extends Controller
    {

        public function listarEventos()
        {
           $data['usuario'] = Auth::user()->name;
           $data['sitio'] = "Lista de Eventos";
           $data['titulo'] = "Eventos";
           return view('listaEventos', $data);            
        }

        public function crearEvento()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Crear Evento";
            $data['titulo'] = "Eventos";
            $data['edicion'] = false;
            return view("crearEvento",$data);
        }

        public function editarEvento()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Editar Evento";
            $data['titulo'] = "Eventos";
            $data['edicion'] = true;
            return view("crearEvento",$data);
        }

        public function subirEvento(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
            $validador = $this->validarFormulario($data);
            $redirect = '/crear/evento';

            if ($validador->passes()) {
                //  guardar en la base de datos
                if ($request->exists('_id')) {
                    $evento = Evento::find($request->input('_id'));                
                }
                else{
                    $evento = new Evento;
                }
                $this->manipularModelo($evento,$request);
            }
            if ($request->exists('_id')) {
                $redirect = '/editar/evento/' . $request->input('_id');
            }
            return redirect($redirect)->withErrors($validador)->withInput();
        }

        public function obtenerEvento(Request $request)
        {
            $response = array();
            if ($request->exists('id')) {
                $data = Evento::find($request->input('id'));

                $formato = [
                    'nombre' => $data['TITULO'],
                    'asunto' => $data['ASUNTO'],
                    'ubicacion' => $data['UBICACION'],
                    'fecha' => $data['FECHA'],
                    'defecha' => $data['DE'],
                    'afecha' => $data['A'],
                    'allday' => $data['ALLDAY'],
                    'cliente' => $data->contacto['CONTACTO_ID'] . '-' . $data->contacto['TITULO']
                     .' '.$data->contacto['NOMBRE'] . ' ' .  $data->contacto['APELLIDO'],
                    'participantes' => $data['PARTICIPANTES'],
                    'descripcion' => $data['DESCRIPCION'],
                    'recordatorio' => $data['RECORDAR'],
                    'repetir' => $data['REPETIR'],
                    'recordar' => $this->getDiasARecordar($data)+1,
                    'horaRecord' => $this->getHoraRecord($data),
                    'inicio' => $data['REPETIR_INICIO'],
                    'finalizacion' => $data['REPETIR_FIN'],
                    'repetira' => $data['REPETIR_DIAS'],
                    'otro' => $data['REPETIR_DIAS']                    
                ];
            }
            return $formato;
        }

        private function getHoraRecord($registro)
        {
            // obtiene a partir de los datos proporcionados del registro 
            // la hora a la que esta configurada el recordatorio
            $fecha = $registro->FECHA_RECORDAR;
            $fecha = date_create($fecha);
            return date_format($fecha,'H:i:s');

        }

        private function getDiasARecordar($registro)
        {
            // obtiene los dias antes de la fecha de vencimiento a lanzar al
            // lanzar el recordatorio
            $fecha = date_create($registro->FECHA_RECORDAR);
            // calcular la diferencia entre el vencimiento y la fecha de recordatorio
            $vencimiento = date_create($registro->FECHA);
            $intervalo = date_diff($fecha,$vencimiento);
            return $intervalo->format('%a');

        }        

        private function validarFormulario($data)
        {
                        // reglas de validacion
            $reglas = array(
                    'nombre' => 'required',
                    'fecha' => 'required|date_format:Y-m-d',
                    'defecha' => 'required_unless:allday,on,date_format:H:i:s',
                    'afecha' => 'required_unless:allday,on,date_format:H:i:s',                 
                    'inicio' => 'required_if:repetir,on|date_format:Y-m-d',
                    'finalizacion' => 'required_if:repetir,on|date_format:Y-m-d',
                    'repetira' => 'required_if:repetir,on',
                    'otro' => 'required_if:repetir,on|integer|required_if:repetira,Otro',             
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

            return  Validator::make($data,$reglas,$mensajes);

        }

        private function manipularModelo($evento,$request)
        {
            $evento->TITULO = $request->input('nombre');

            $evento->USUARIO_ID = Auth::user()->id;

            $evento->ASUNTO = $request->input('asunto');
            if ($request->exists('cliente')) {
                $evento->CONTACTO_ID = $request->input('buscar-contacto');
            }
            $evento->FECHA = $request->input('fecha');
            if ($request->input('allday') == 'on') {
                $evento->DE = '00:00:00';
                $evento->A = '23:59:00';
                $evento->ALLDAY = true;
            }
            else{
                $evento->DE = $request->input('defecha');
                $evento->A = $request->input('afecha');
            }
            if ($request->exists('ubicacion')) {
                $evento->UBICACION = $request->input('ubicacion');
            }

            if ($request->exists('participantes')) {
                $evento->PARTICIPANTES = $request->input('participantes');
            }                
            if ($request->exists('descripcion')) {
                $evento->DESCRIPCION = $request->input('descripcion');
            }
            // crear el registro del recordatorio y notificacion y ligarlos 
            // a las claves foraneas en evento
            if ($request->exists('descripcion')) {
                $evento->DESCRIPCION = $request->input('descripcion');
            }

            if ($request->input('recordatorio') == 'on') {       
                $evento->RECORDAR = true;      
                // crear una fecha DATETIME a partir de la fecha de vencimiento
                $dia = intval($request->input('recordar')) * (24*60*60);
                $dia = date('Y-m-d',strtotime($request->input('fecha')) - $dia);
                $fecha = $dia . ' ' . $request->input('horaRecord');

                $evento->FECHA_RECORDAR = $fecha;
            }
            if ($request->input('repetir') == 'on') {
                $evento->REPETIR = true;
                $evento->REPETIR_INICIO = $request->input('inicio');
                $evento->REPETIR_FIN = $request->input('finalizacion');
                if ($request->input('repetira') == 'Otro') {
                    $evento->REPETIR_DIAS = $request->input('otro');
                }
                else{
                    $evento->REPETIR_DIAS = $request->input('repetira');
                }                
            }
            if ($request->exists('cliente')) {
                $id = explode('-', $request->input('cliente'));
                $cliente_id = $id[0];
                $cliente = Contacto::find($cliente_id);

                if ($cliente) {
                    $evento->CONTACTO_ID = $cliente->CONTACTO_ID;
                }                
            }

            $evento->save();      
        }

    }
 ?>