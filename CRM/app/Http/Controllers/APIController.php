<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Contacto;
    use App\Campana;
    use App\Evento;
    use App\Oportunidad;
    use App\Recordatorio;
    use App\Repeticion;
    use App\Tarea;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    /**
    * Controlador para la seccion de prospectos
    */
    class APIController extends Controller
    {
        // NOTA : este codigo es feo por que es poco flexible y escalable pero 
        // se hizo con el tiempo encima
        public function contactos(Request $request)
        {
            // todas las solicitudes que tenga que ver con los contactos van aqui
            // obtener todas las opciones declaradas en la solicitud
            // que tipo de contacto es

            // este es un array json que contendra los datos formateados correctamente
            $response = array();

            if ($request->input('here') == '/ver/prospectos') {
                // el parametro es el limite superior de la consulta
                $data = Contacto::orderBy($request->input('orderby'),'asc')
                ->where('ESCLIENTE','=','0')->skip($request->input('pagina')-10)->take(10)->get();

                foreach ($data as $contacto) {
                    $formato = [
                        'id' => $contacto['CONTACTO_ID'],
                        'nombre'=> $contacto['NOMBRE'],
                        'correo' => $contacto['CORREO'],
                        'Telefono' => $contacto['TELEFONO'],
                        'creacion' => $contacto['created_at'],
                        'empresa' => $contacto['EMPRESA'],
                        'estado' => $contacto['ESTADO'],
                        'calificacion' => $contacto['CALIFICACION'],
                        'origen' => $contacto['ORIGEN']
                    ];
                    array_push($response, $formato);
                }
            }
            return response()->json($response);   
        }
        public function clientes(Request $request)
        {
            $response = array();
            if ($request->input('here') == '/ver/clientes') {
                // el parametro es el limite superior de la consulta
                $data = Contacto::orderBy($request->input('orderby'),'asc')
                ->where('ESCLIENTE','=','1')->skip($request->input('pagina')-10)->take(10)->get();

                foreach ($data as $contacto) {
                    $formato = [
                        'id' => $contacto['CONTACTO_ID'],
                        'nombre'=> $contacto['NOMBRE'],
                        'correo' => $contacto['CORREO'],
                        'Telefono' => $contacto['TELEFONO'],
                        'creacion' => $contacto['created_at'],
                        'empresa' => $contacto['EMPRESA'],
                        'estado' => $contacto['ESTADO'],
                        'calificacion' => $contacto['CALIFICACION'],
                        'origen' => $contacto['ORIGEN']
                    ];
                    array_push($response, $formato);
                }
            }
            return response()->json($response);               
        }
        public function campanas(Request $request)
        {
            $response = array();
            if ($request->input('here') == '/ver/campanas') {
                // el parametro es el limite superior de la consulta
                if ($request->input('vertodas') == 'true') {
                    $data = Campana::orderBy($request->input('orderby'),'asc')
                    ->skip($request->input('pagina')-10)->take(10)->get();                    
                }
                else{
                    $data = Campana::orderBy($request->input('orderby'),'asc')
                    ->where('ACTIVA','=','1')->skip($request->input('pagina')-10)->take(10)->get();                    
                }

                foreach ($data as $campana) {
                    $formato = [
                        'id' => $campana['CAMPANA_ID'],
                        'nombre'=> $campana['NOMBRE'],
                        'estado' => $campana['ESTADO'],
                        'tipo' => $campana['TIPO'],
                        'activa' => $campana['ACTIVA'],
                        'inicio' => $campana['INICIO'],
                        'fin' => $campana['FINALIZACION'],
                        'creacion' => $campana['created_at'],
                    ];
                    array_push($response, $formato);
                }
            }
            return response()->json($response);               
        }
        public function oportunidades(Request $request)
        {
            $response = array();
            $pagina = $request->input('pagina');
            $nextpag = $request->input('nextpag') - $pagina;

            if ($request->input('here') == '/ver/oportunidades') {
                $data = Oportunidad::orderBy($request->input('orderby'),'asc')
                ->where('CIERRE','>=',date('Ymd'))->skip($pagina)
                ->take($nextpag)->get();


                foreach ($data as $oportunidad) {
                    $formato = [
                    'fecha' => $oportunidad['CIERRE'],
                    'cliente' => $oportunidad['CONTACTO_ID'],
                    'titulo' => $oportunidad['TITULO'],
                    'tipo' => $oportunidad['TIPO'],
                    'id' =>  $oportunidad['OPORTUNIDAD_ID']
                    ];
                    array_push($response, $formato);
                }                
            }

            return response()->json($response);

        }

        public function tareas(Request $request)
        {
            $response = array();
            $pagina = $request->input('pagina');
            $nextpag = $request->input('nextpag') - $pagina;

            if ($request->input('here') == '/ver/tareas') {
                $data = Tarea::orderBy($request->input('orderby'),'asc')
                ->where('VENCIMIENTO','>=',date('Ymd'))->where('ESTADO','<>','Completada')
                ->skip($pagina)->take($nextpag)->get();


                foreach ($data as $tarea) {
                    $formato = [
                        'id' => $tarea['TAREA_ID'],
                        'cliente' => $tarea['CONTACTO_ID'],
                        'fecha' => $tarea['VENCIMIENTO'],
                        'titulo' => $tarea['TITULO'],
                        'asunto' => $tarea['ASUNTO'],
                        'estado' => $tarea['ESTADO'],
                        'prioridad' => $tarea['PRIORIDAD']                        
                    ];
                    array_push($response, $formato);
                }                
            }

            return response()->json($response);

        }

        public function eventos(Request $request)
        {
            $response = array();

            //formar con la fecha del calendario la de consulta

            if ($request->input('here') == '/ver/eventos') {
                $data = Evento::whereBetween('FECHA',
                 array(date('Ymd',$request->input('date')),date('Ymd',time() + (31 * 24 * 60 * 60))))
                ->get();

                // convertir la fechas en el formato apropiado

                foreach ($data as $evento) {
                    $formato = [
                        'titulo' => $evento['TITULO'],
                        'tiempo' => $evento['FECHA'] . ' ' .$evento['A'],
                        'tiempofin' => $evento['FECHA'] . ' ' . $evento['DE'],
                        'asunto' => $evento['ASUNTO'],
                        'ubicacion' => $evento['UBICACION'],
                        'id' => $evento['EVENTO_ID'],
                        'isallday' => $evento['ALLDAY'],
                    ];
                    array_push($response, $formato);
                }
            }
            return response()->json($response);       
        }        

    }
 ?>