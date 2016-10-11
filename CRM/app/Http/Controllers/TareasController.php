<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Tarea;
    use App\Contacto; 
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;
    /**
    * Controlador para la seccion de tareas
    */
    class TareasController extends Controller
    {

        public function listarTareas()
        {
           $data['usuario'] = Auth::user()->name;
           $data['sitio'] = "Lista de Tareas";
           $data['titulo'] = "Tareas";
           return view('listaTareas', $data);            
        }

        public function crearTarea()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Crear Tarea";
            $data['titulo'] = "Tareas";
            $data['edicion'] = false;
            return view("crearTarea",$data);
        }

        public function editarTarea()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Editar Tarea";
            $data['titulo'] = "Tareas";
            $data['edicion'] = true;
            return view("crearTarea",$data);
        }        

        public function subirTarea(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
            $redirect = "/crear/tarea";
            $validador = $this->validarFormulario($data);
            if ($validador->passes()) {
                //  guardar en la base de datos
                if ($request->exists('_id')) {
                    $tarea = Tarea::find($request->input('_id'));
                }
                else{
                    $tarea = new Tarea;
                }
                $this->manipularModelo($tarea,$request);
            }
            if ($request->exists('_id')) {
                $redirect = '/editar/tarea/' . $request->input('_id');
            }
            return redirect($redirect)->withErrors($validador)->withInput();
        }

        public function obtenerTarea(Request $request)
        {
            $response = array();
            if ($request->exists('id')) {
                $data = Tarea::find($request->input('id'));
                $formato = [
                    'nombre' => $data['TITULO'],
                    'asunto' => $data['ASUNTO'],
                    'vencimiento' => $data['VENCIMIENTO'],
                    'cliente' => $data->contacto['CONTACTO_ID'] . '-' . $data->contacto['TITULO'] .' '.$data->contacto['NOMBRE']
                                 . ' ' .  $data->contacto['APELLIDO'],
                    'estado' => $data['ESTADO'],
                    'prioridad' => $data['PRIORIDAD'],
                    'notificarcorreo' => $data['NOTIFICACION'],
                    'descripcion' => $data['DESCRIPCION'],
                    'recordatorio' => $data['RECORDAR'],
                    'repetir' => $data['REPETIR'],
                    'recordar' => $this->getDiasARecordar($data) + 1,
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
            $vencimiento = date_create($registro->VENCIMIENTO);
            $intervalo = date_diff($fecha,$vencimiento);
            return $intervalo->format('%a');

        }

        private function validarFormulario($data)
        {
            // reglas de validacion
            $reglas = array(
                    'nombre' => 'required',
                    'estado' => 'required',
                    'vencimiento' => 'date_format:Y-m-d',
                    'prioridad' => 'required',
                    'recordar' => 'required_if:recordatorio,on',
                    'horaRecord' => 'required_if:recordatorio,on|date_format:H:i:s',
                    'inicio' => 'required_if:repetir,on|date_format:Y-m-d',
                    'finalizacion' => 'required_if:repetir,on|date_format:Y-m-d',
                    'repetira' => 'required_if:repetir,on',
                    'otro' => 'required_if:repetir,on|integer|required_if:repetira,Otro'          
   
                );

            $mensajes = array(
                'required' => 'Este campo es requerido',
                'regex' => 'El campo debe seguir el formato establecido',
                'required_with' => 'Los demas campos deben de estar señalados',
                'data_format' => 'La fecha debe estar en el campo prestablecido',
                'required_if' => 'Los demas campos deben de ser señalados',
                'integer' => 'El campo debe ser un entero'
                );

            return Validator::make($data,$reglas,$mensajes);            
        }

        private function manipularModelo ($tarea,$request)
        {
            $tarea->TITULO = $request->input('nombre');

            $tarea->USUARIO_ID = Auth::user()->id;

            $tarea->ASUNTO = $request->input('asunto');
            $tarea->VENCIMIENTO = $request->input('vencimiento');
            $tarea->ESTADO = $request->input('estado');
            $tarea->PRIORIDAD = $request->input('prioridad');
            if ($request->input('notificarcorreo') == 'on') {
                $tarea->NOTIFICACION = true;
            }

            if ($request->exists('descripcion')) {
                $tarea->DESCRIPCION = $request->input('descripcion');
            }

            if ($request->input('recordatorio') == 'on') {       
                $tarea->RECORDAR = true;      
                // crear una fecha DATETIME a partir de la fecha de vencimiento
                $dia = intval($request->input('recordar')) * (24*60*60);
                $dia = date('Y-m-d',strtotime($request->input('vencimiento')) - $dia);
                $fecha = $dia . ' ' . $request->input('horaRecord');

                $tarea->FECHA_RECORDAR = $fecha;
            }
            if ($request->input('repetir') == 'on') {

                $tarea->REPETIR = true;
                $tarea->REPETIR_INICIO = $request->input('inicio');
                $tarea->REPETIR_FIN = $request->input('finalizacion');
                if ($request->input('repetira') == 'Otro') {
                    $tarea->REPETIR_DIAS = $request->input('otro');
                }
                else{
                    $tarea->REPETIR_DIAS = $request->input('repetira');
                }
            }
            if ($request->exists('cliente')) {
                $id = explode('-', $request->input('cliente'));
                $cliente_id = $id[0];
                $cliente = Contacto::find($cliente_id);

                if ($cliente) {
                    $tarea->CONTACTO_ID = $cliente->CONTACTO_ID;
                }                
            }

            $tarea->save();        
        }
    }
 ?>