<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Tarea;
    use App\Recordatorio;
    use App\Repeticion;        
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    /**
    * Controlador para la seccion de tareas
    */
    class TareasController extends Controller
    {

        public function listarTareas()
        {
           $data['usuario'] = "Administrador";
           $data['sitio'] = "Lista de Tareas";
           $data['titulo'] = "Tareas";
           return view('listaTareas', $data);            
        }

        public function crearTarea()
        {
            $data['usuario'] = "Administrador";
            $data['sitio'] = "Crear Tarea";
            $data['titulo'] = "Tareas";
            $data['edicion'] = false;
            return view("crearTarea",$data);
        }

        public function subirTarea(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
            // reglas de validacion
            $reglas = array(
                    'nombre' => 'required',
                    'asunto' => 'required',
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

            $validador = Validator::make($data,$reglas,$mensajes);

            if ($validador->passes()) {
                //  guardar en la base de datos
                $tarea = new Tarea;
                $tarea->TITULO = $request->input('nombre');

                // TODO : insertar el id del usuario actual
                $tarea->USUARIO_ID = 1;

                $tarea->ASUNTO = $request->input('asunto');
                $tarea->VENCIMIENTO = $request->input('vencimiento');
                if ($request->exists('buscar-contacto')) {
                    $tarea->CONTACTO_ID = $request->input('buscar-contacto');
                }
                $tarea->ESTADO = $request->input('estado');
                $tarea->PRIORIDAD = $request->input('prioridad');
                if ($request->input('notificarcorreo') == 'on') {
                    $tarea->NOTIFICACION = true;
                }

                if ($request->exists('descripcion')) {
                    $tarea->DESCRIPCION = $request->input('descripcion');
                }

                $tarea->save();
                // crear el registro del recordatorio y notificacion y ligarlos 
                // a las claves foraneas en Tarea
                if ($request->input('recordatorio') == 'on') {
                    

                    $recordatorio = new Recordatorio;
                    $recordatorio->DIAS = $request->input('recordar');
                    $recordatorio->HORA = $request->input('horaRecord');
                    $recordatorio->save();
                    $tarea->RECORDAR = true;
                    $tarea->RECORDATORIO_ID =  $recordatorio->RECORDATORIO_ID;
                    $tarea->save();
                }
                if ($request->input('repetir') == 'on') {
                    $tarea->REPETIR = true;

                    $repeticion = new Repeticion;
                    $repeticion->INICIO = $request->input('inicio');
                    $repeticion->FIN = $request->input('finalizacion');
                    if ($request->input('repetira') == 'Otro') {
                        $repeticion->REPETIR_DIAS = $request->input('otro');
                    }
                    else{
                        $repeticion->REPETIR_DIAS = $request->input('repetira');
                    }
                    $repeticion->save();
                    $tarea->REPETICION_ID =  $repeticion->REPETICION_ID;
                    $tarea->save();
                }
            }
            return redirect('/crear/tarea')->withErrors($validador)->withInput();
        }
    }
 ?>