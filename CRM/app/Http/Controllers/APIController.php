<?php 

    namespace App\Http\Controllers;
    use Validator;
    // modelos
    use App\Contacto;
    use App\Campana;
    use App\Evento;
    use App\Oportunidad;
    use App\Recordatorio;
    use App\Repeticion;
    use App\Tarea;
    // controladores
    use App\Http\Controllers\ProspectosController;
    use App\Http\Controllers\CampanasController;
    use App\Http\Controllers\ClientesController;
    use App\Http\Controllers\EventosController;
    use App\Http\Controllers\OportunidadesController;
    use App\Http\Controllers\TareasController;
    // framework
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
                    'cliente' => $oportunidad->contacto['NOMBRE'],
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
                        'cliente' => $tarea->contacto['NOMBRE'],
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

        private function getTareas($id)
        {
            // obtener las tareas relacionadas con un cliente en
            // especifico
            $response = array();
            $data = Tarea::where('CONTACTO_ID','=',$id)->get();

            foreach ($data as $tarea) {
                $formato = [
                    'url' => url('/editar/tarea/'.$tarea['TAREA_ID']),
                    'asunto' => $tarea['ASUNTO'],
                    'vencimiento' => $tarea['VENCIMIENTO'],
                    'estado' => $tarea['ESTADO'],
                    'prioridad' => $tarea['PRIORIDAD']
                ];
                array_push($response, $formato);
            }

            return $response;
        }

        private function getEventos($id)
        {
            $response = array();
            $data = Evento::where('CONTACTO_ID','=',$id)->get();

            foreach ($data as $evento) {
                $formato = [
                    'url' => url('/editar/evento/'.$evento['EVENTO_ID']),
                    'titulo' => $evento['TITULO'],
                    'ubicacion' => $evento['UBICACION'],
                    'fecha' => $evento['FECHA']
                ];
                array_push($response, $formato);
            }

            return $response;            
        }
        private function getOportunidades($id)
        {
            $response = array();
            $data = Oportunidad::where('CONTACTO_ID','=',$id)->get();

            foreach ($data as $oportunidad) {
                $formato = [
                    'url' => url('/editar/oportunidad/'.$oportunidad['OPORTUNIDAD_ID']),
                    'titulo' => $oportunidad['TITULO'],
                    'etapa' => $oportunidad['ETAPA'],
                    'tipo' => $oportunidad['TIPO'],
                    'fecha' => $oportunidad['CIERRE']
                ];
                array_push($response, $formato);
            }

            return $response;            
        }


        public function detalles(Request $request)
        {
            // devolver los datos en separados en aun array
            $response = array();
            // todas las vistas detalles se dirigen a este metodo el cual obtendra 
            // los datos a traves de los demas controladores  

            // obtener el id de la entidad relacionada

              
            if ($request->exists('/obtener/prospecto')) {
                // obtener los datos del prospecto con el id indicado
                $id = $request->input('/obtener/prospecto');
                $id = $id['id'];
                $data = ProspectosController::getProspecto($id);
                $response['cliente'] = $data;
            }
            if ($request->exists('/obtener/cliente')) {
                $id = $request->input('/obtener/cliente');
                $id = $id['id'];

                $data = ClientesController::getCliente($id);
                $response['cliente'] = $data;
            }

            if ($request->exists('/obtener/campana')) {
                $id = $request->input('/obtener/campana');
                $id = $id['id'];
                $data = CampanasController::getCampana($id);
                $response['campana'] = $data;                                 
            }             


            // elementos relacionados con objetos basicos
            // tareas
            if ($request->exists('/obtener/tareas')) {
                
                $id = $request->input('/obtener/tareas');
                $id = $id['isMember'];
                $data = $this->getTareas($id);
                $response['tareas'] = $data;
            }                        

            if ($request->exists('/obtener/eventos')) {
                
                $id = $request->input('/obtener/eventos');
                $id = $id['isMember'];
                $data = $this->getEventos($id);
                $response['eventos'] = $data;
            }
            if ($request->exists('/obtener/oportunidades')) {
                
                $id = $request->input('/obtener/oportunidades');
                $id = $id['isMember'];
                $data = $this->getOportunidades($id);
                $response['oportunidades'] = $data;
            }


            return $response;

        }

        public function buscador(Request $request)
        {
            // dependiendo del tipo de elemento lanzar una respuesta

            $solicitudes = explode(',',$request->input('solicitud'));
            $response = array();

            foreach ($solicitudes as $objeto) {
                
                switch ($objeto) {
                    case 'campaña':
                        //buscar una campaña
                        $data = CampanasController::buscarCampana($request->input('valor'));
                        // dar formato apropiado
                        foreach ($data as $campana) {
                            $formato = [
                                'id' => $campana['CAMPANA_ID'],
                                'nombre' => $campana['NOMBRE'],                                
                            ];      
                            array_push($response, $formato);
                        }   
                        break;                
                    case 'cliente':
                        $data = ClientesController::buscarContacto($request->input('valor'));
                        foreach ($data as $contacto) {
                            $formato = [
                                'id' => $contacto['CONTACTO_ID'],
                                'nombre' => $contacto['TITULO'] . ' '. $contacto['NOMBRE'] . ' ' . $contacto['APELLIDO'],

                            ];
                            array_push($response, $formato);
                        }                        
                        break;

                }
            }
            return $response;
        }

    }
 ?>