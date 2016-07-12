<?php 

    namespace App\Http\Controllers;
    use Validator;
    //modelos
    use App\Contacto;
    use App\Campana;
    use App\Oportunidad;
    //
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;

    /**
    * Controlador para la seccion de informes
    */
    class InformesController extends Controller
    {
        public function listado()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = 'Lista de Informes';
            $data['titulo'] = 'Informes';

            return view('listaInformes', $data);
        }

        public function generarInforme(Request $request,$clasificacion,$tipo)
        {
            // redirigir los datos de acuerdo al tipo de informe que se requiera
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = '';
            $data['titulo'] = 'Informes';
            $vista = 'listaInformes';

            // retornar en data['informe'] un arreglo con los datos de las estructuras
            // de la forma $data['informe']['fila']['columnas']

            if ($clasificacion == 'cliente') {
                
                if ($tipo == 'clasificacion') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;     
                    $data['cantidad'] = false;               
                    $data['sitio'] = 'Clientes por clasificacion';
                    $data['informe'] = $this->clienteClasificacion($request);
                    $data['tab'] = ['Clasificacion','Cantidad de clientes','Ingresos generados'];
                    $data['action'] = url('/ver/informe/cliente/clasificacion');
                    $vista = 'informe.contactoBasico';
                }
                else if ($tipo == 'generados') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;  
                    $data['cantidad'] = false;                  
                    $data['sitio'] = 'Clientes generados';
                    $data['informe'] = $this->clienteGenerados($request);
                    $data['tab'] = ['Nombre','Tipo','Origen','Estado','Creacion'];
                    $data['action'] = url('/ver/informe/cliente/generados');
                    $vista = 'informe.contactoBasico';                    
                }
                else if ($tipo == 'clave') {
                    $data['botonera'] = true;
                    $data['grafico'] = false; 
                    $data['cantidad'] = true;                   
                    $data['sitio'] = 'Clientes con mas Oportunidades';
                    $data['informe'] = $this->clientesClave($request);
                    $data['tab'] = ['Cliente/Oportunidades','Fase','Importe','Fecha de Cierre'];
                    $data['action'] = url('/ver/informe/cliente/clave');
                    $vista = 'informe.contactoBasico';
                }
                else if ($tipo == 'olvidados') {
                    $data['botonera'] = true;
                    $data['grafico'] = false;     
                    $data['cantidad'] = true;                    
                    $data['sitio'] = 'Clientes con menos Oportunidades';
                    $data['informe'] = $this->clientesClave($request,true);
                    $data['tab'] = ['Cliente/Oportunidades','Fase','Importe','Fecha de Cierre'];
                    $data['action'] = url('/ver/informe/cliente/olvidados');
                    $vista = 'informe.contactoBasico';
                }
                else if ($tipo == 'relacion') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;
                    $data['cantidad'] = false;
                    $data['tab'] = ['Cliente','# de oportunidades','Ingreso'];
                    $data['sitio'] = 'Relacion Clientes/Oportunidades';
                    $data['action'] = url('/ver/informe/cliente/relacion');
                    $data['informe'] = $this->clienteRelacion($request);
                    $vista = 'informe.contactoBasico';
                }
            }

            if ($clasificacion == 'oportunidad') {
                if ($tipo == 'perdida') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;     
                    $data['sitio'] = 'Cantidad de oportunidades perdidas';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Cliente','Titulo Oportunidad','Ingreso Perdido','Fecha de creacion','Detalles'];                    
                    $data['action'] = url('/ver/informe/oportunidad/perdida');
                    $data['informe'] = $this->oportunidadPerdida($request);
                    $vista = 'informe.informeWithUrl';                    
                }
                else if ($tipo == 'abierta') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Cantidad de oportunidades abiertas';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Cliente','Titulo Oportunidad','Ingreso','Fecha de creacion','Detalles'];                    
                    $data['action'] = url('/ver/informe/oportunidad/perdida');
                    $data['informe'] = $this->oportunidadPerdida($request,true);
                    $vista = 'informe.informeWithUrl';                    
                    
                }
                else if ($tipo == 'probabilidad') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Oportunidades por su porcentaje de probabilidad';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Porcentaje','Cliente','Titulo Oportunidad','Etapa','Ingreso','Fecha de creacion','Detalles'];                    
                    $data['action'] = url('/ver/informe/oportunidad/probabilidad');
                    $data['informe'] = $this->oportunidadPor($request,'probabilidad');
                    $vista = 'informe.informeWithUrl'; 
                }
                else if ($tipo == 'fase') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Oportunidades por fase en la que se encuentran';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Etapa','Cliente','Titulo Oportunidad','Etapa','Ingreso','Fecha de creacion','Detalles'];                    
                    $data['action'] = url('/ver/informe/oportunidad/fase');
                    $data['informe'] = $this->oportunidadPor($request,'etapa');
                    $vista = 'informe.informeWithUrl'; 
                }                
                else if ($tipo == 'tipo') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Oportunidades por tipo de oportunidad';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Tipo','Cliente','Titulo Oportunidad','Etapa','Ingreso','Fecha de creacion','Detalles'];                    
                    $data['action'] = url('/ver/informe/oportunidad/tipo');
                    $data['informe'] = $this->oportunidadPor($request,'tipo');
                    $vista = 'informe.informeWithUrl'; 
                }                                
                else if ($tipo == 'origen') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Oportunidades por origen del cliente';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Origen','Cliente','Titulo Oportunidad','Etapa','Ingreso','Fecha de creacion','Detalles'];                    
                    $data['action'] = url('/ver/informe/oportunidad/origen');
                    $data['informe'] = $this->oportunidadPor($request,'origen');
                    $vista = 'informe.informeWithUrl'; 
                }
                else if ($tipo == 'proximos') {
                    $data['botonera'] = false;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Oportunidades cuyo fecha de cierre es en los proximos 7 dias';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Titulo','Fase','Cliente','Fecha de Cierre','Edicion'];                    
                    $data['action'] = url('/ver/informe/oportunidad/proximos');
                    $data['informe'] = $this->oportunidadesProximos($request);
                    $vista = 'informe.informeWithUrl';                     
                }
                else if ($tipo == 'mes') {
                    $data['botonera'] = false;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Resumen de oportunidades cerradas favorablemente este mes';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Titulo','Cliente','Importe','Edicion'];                    
                    $data['action'] = url('/ver/informe/oportunidad/proximos');
                    $data['informe'] = $this->oportunidadesActuales($request,'mes');
                    $vista = 'informe.informeWithUrl';                     
                }                
                else if ($tipo == 'hoy') {
                    $data['botonera'] = false;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Resumen de oportunidades cerradas favorablemente el dia de hoy';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Titulo','Cliente','Importe','Edicion'];                    
                    $data['action'] = url('/ver/informe/oportunidad/proximos');
                    $data['informe'] = $this->oportunidadesActuales($request,'hoy');
                    $vista = 'informe.informeWithUrl';                     
                }                  
            }
            if ($clasificacion == 'prospecto') {
                if ($tipo == 'tipo') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Cantidad de prospectos por el tipo';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Tipo','Nombre','Estado','Calificacion','Valoracion','Fecha de creacion','Edicion'];
                    $data['action'] = url('/ver/informe/prospecto/tipo');
                    $data['informe'] = $this->prospectoClasificacion($request,'tipo');
                    $vista = 'informe.informeWithUrl';                     
                }
                if ($tipo == 'origen') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Cantidad de prospectos por origen';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Origen','Nombre','Estado','Calificacion','Valoracion','Fecha de creacion','Edicion'];
                    $data['action'] = url('/ver/informe/prospecto/origen');
                    $data['informe'] = $this->prospectoClasificacion($request,'origen');
                    $vista = 'informe.informeWithUrl';                     
                }
                if ($tipo == 'estado') {
                    $data['botonera'] = true;
                    $data['grafico'] = true;                    
                    $data['sitio'] = 'Cantidad de prospectos por estado';
                    $data['cantidad'] = false;                          
                    $data['tab'] = ['Estado','Nombre','Estado','Calificacion','Valoracion','Fecha de creacion','Edicion'];
                    $data['action'] = url('/ver/informe/prospecto/estado');
                    $data['informe'] = $this->prospectoClasificacion($request,'estado');
                    $vista = 'informe.informeWithUrl';                     
                }                

            }
            return view($vista,$data);
            // return $data['informe'];
        }

        public function obtenerDatos(Request $request)
        {
            // ver public/js/informe.js

            $columnas = [
                'contacto' => ['CONTACTO_ID'],
                'oportunidad' => ['OPORTUNIDAD_ID'],
                'relaciones' => [
                    'contacto' => []
                ]
            ];
            $data = array();
            if ($request->exists('contacto')) {
                // campos
                
                if ($request->has('contacto.campos')) {
                    $campos = $request->input('contacto.campos');
                    foreach ($campos as $columna) {
                        switch ($columna) {                            
                            case 'tipo':
                                array_push($columnas['contacto'], 'TIPO');
                                break;
                            case 'origen':
                                array_push($columnas['contacto'], 'ORIGEN');
                                break;
                            case 'ingresos':                        
                                array_push($columnas['relaciones']['contacto'], 'ingresos');
                                // luego gestionar la relacion
                                break;
                            case 'created':
                                array_push($columnas['contacto'], 'created_at');
                                break;
                            case 'estado':
                                array_push($columnas['contacto'], 'ESTADO');
                                break;
                            case 'nombre':                                
                                array_push($columnas['contacto'], 'TITULO');
                                array_push($columnas['contacto'], 'NOMBRE');
                                array_push($columnas['contacto'], 'APELLIDO');
                                break;
                            case 'Noportunidades':
                                array_push($columnas['relaciones']['contacto'] , 'Noportunidades');
                                break;
                            case 'listaOportunidades':
                                array_push($columnas['relaciones']['contacto'] ,'listaOportunidades');
                        }
                    }
                }
                if ($request->input('contacto.cliente') == true) {
                    $dataDB = $this->clientes($columnas['contacto']);
                    $data['contacto'] = $this->formatearSalida('contacto',$columnas,$dataDB);
                    // formatear los datos
                }
                else{
                    $dataDB = $this->contactos($columnas['contacto']);
                    $data['contacto'] = $this->formatearSalida('contacto',$columnas,$dataDB);
                }
            }
            if ($request->exists('oportunidad')) {
                if ($request->exists('oportunidad.campos')) {
                    foreach ($campos as $columna) {
                        switch ($columna) {
                            case 'titulo':
                                array_push($columnas['oportunidad'] , 'TITULO');
                                break;
                            case 'etapa':
                                array_push($columnas['oportunidad'] , 'ETAPA');
                                break;
                        }
                    }
                }
            }
            return response()->json($data);
        }

        private function formatearSalida($modelo,$columnas,$dataDB)
        {
            $formato = array();
            if ($modelo == 'contacto') {
                $datos = $columnas['contacto'];
                foreach ($dataDB as $registro) {
                    $objeto = array();
                    if (in_array('TIPO', $datos)) {
                        $objeto['tipo'] = $registro->TIPO;
                    }
                    if (in_array('ORIGEN', $datos)) {
                        $objeto['origen'] = $registro->ORIGEN;
                    }
                    if (in_array('created_at', $datos)) {
                        $objeto['created'] = strval($registro->created_at);
                    }
                    if (in_array('ESCLIENTE', $datos)) {
                        $objeto['escliente'] = $registro->ESCLIENTE;
                    }
                    if (in_array('NOMBRE', $datos)) {
                        $objeto['nombre'] = $registro->TITULO . ' ' . $registro->NOMBRE . ' ' . $registro->APELLIDO;
                    }
                    if (in_array('ESTADO', $datos)) {
                        $objeto['estado'] = $registro->ESTADO;
                    }
                    if (in_array('CALIFICACION', $datos)) {
                        $objeto['calificacion'] = $registro->CALIFICACION;
                    }
                    if (in_array('VALORACION', $datos)) {
                        $objeto['valoracion'] = $registro->VALORACION;
                    }
                    if (in_array('SECTOR', $datos)) {
                        $objeto = $registro->SECTOR;
                    }
                    if (array_key_exists('relaciones', $columnas) && array_key_exists('contacto', $columnas['relaciones'])) {
                        if (in_array('ingresos', $columnas['relaciones']['contacto'])) {
                            // inversiones 
                            $inversiones = $this->buscarEnRelacion($registro->oportunidades,'INVERSION');
                            $suma = 0;
                            foreach ($inversiones as $inv) {
                                $suma += $inv;
                            }
                            $objeto['inversion'] = $suma;
                            $ingresos = $this->buscarEnRelacion($registro->oportunidades,'IMPORTE');
                            $suma = 0;
                            foreach ($ingresos as $ing) {
                                $suma += $ing;
                            }
                            $objeto['ingresos'] = $suma;
                        }
                        if (in_array('url', $columnas['relaciones']['contacto'])) {
                            $objeto['url'] = url('/editar/prospecto/'.$registro->CONTACTO_ID);
                        }
                    }
                    if (array_key_exists('relaciones', $columnas)) {
                        if (in_array('Noportunidades', $columnas['relaciones']['contacto'])) {
                            $conteo = count($registro->oportunidades);
                            $objeto['Noportunidades'] = $conteo;
                        }
                        if (in_array('listaOportunidades', $columnas['relaciones']['contacto'])) {
                            $objeto['listaOportunidades'] = array();
                            foreach ($registro->oportunidades as $oportunidad) {
                                $op = [
                                    'titulo' => $oportunidad->TITULO,
                                    'fase' => $oportunidad->ETAPA,
                                    'importe' => $oportunidad->IMPORTE,
                                    'cierre' => $oportunidad->CIERRE
                                ];
                                array_push($objeto['listaOportunidades'] , $op);
                            }
                        }
                    }
                    array_push($formato, $objeto);
                }
            }
            if ($modelo == 'oportunidad') {
                $datos = $columnas['oportunidad'];
                foreach ($dataDB as $registro) {
                    $objeto = array();
                    if (in_array('TITULO', $datos)) {
                        $objeto['titulo'] = $registro->TITULO;
                    }
                    if (in_array('IMPORTE', $datos)) {
                        $objeto['importe'] = $registro->IMPORTE;
                    }
                    if (in_array('created_at', $datos)) {
                        $objeto['created'] = strval($registro->created_at);
                    }
                    if (in_array('TIPO', $datos)) {
                        $objeto['tipo'] = strval($registro->TIPO);
                    }                           
                    if (in_array('ETAPA', $datos)) {
                        $objeto['etapa'] = $registro->ETAPA;
                    }
                    if (in_array('PROBABILIDAD', $datos)) {
                        $objeto['probabilidad'] = $registro->PROBABILIDAD;
                    }
                    if (in_array('CIERRE', $datos)) {
                        $objeto['cierre'] = $registro->CIERRE;
                    }                    
                    if (array_key_exists('relaciones', $columnas)) {
                        if (in_array('url', $columnas['relaciones']['oportunidad'])) {
                            $objeto['url'] = url('/editar/oportunidad/'.$registro->OPORTUNIDAD_ID);
                        }
                        if (in_array('cliente', $columnas['relaciones']['oportunidad'])) {
                            $objeto['cliente'] = $registro->contacto['TITULO'] . ' ' . 
                            $registro->contacto['NOMBRE'] . ' ' . $registro->contacto['APELLIDO'];
                        }
                        if (in_array('origen', $columnas['relaciones']['oportunidad'])) {
                            $objeto['origen'] = $registro->contacto['ORIGEN'];                            
                        }
                    }
                    array_push($formato, $objeto);
                }

                
            }
            return $formato;
        }

        private function buscarEnRelacion($coleccion,$columna)
        {
            // buscar en cada  relacion la columna especificada;
            $rtrn = array();
            foreach ($coleccion as $registro) {
                array_push($rtrn, $registro[$columna]);
            }
            return $rtrn;
        }

        // funciones encargadas de recoger los datos
        private function clientes($columnas = array(),$rango = array())
        {
            if (count($rango) > 0) {
                return Contacto::where('ESCLIENTE' , '=','1')->
                whereBetween('created_at',array($rango[0],$rango[1]))
                ->get($columnas);
            }
            else{
                return Contacto::where('ESCLIENTE' , '=','1')->get($columnas);
            }
        }


        private function oportunidades($columnas = array(),$rango = array())
        {
            return Oportunidad::get($columnas);
        }

        private function oportunidadesFilter($columnas = array(),$rango=array(),$filter=array())
        {   
            // se asume que filtro esta declarado
            if (count($rango)>0) {
                return Oportunidad::where($filter[0],$filter[1],$filter[2])->
                whereBetween('created_at',$rango)->get($columnas);
            }
            else{
                return Oportunidad::where($filter[0],$filter[1],$filter[2])->get($columnas);
            }
        }

        private function contactos($columnas = array(),$rango= array())
        {
            if (count($rango) > 0) {
                return Contacto::
                whereBetween('created_at',array($rango[0],$rango[1]))
                ->get($columnas);
            }
            else{
                return Contacto::get($columnas);
            }
       
        }    

        private function clientesClave($request,$reverse=false)
        {
            // obtener los n clientes con mayor numero de oportunidades
            $columnas = [
                'contacto' => ['CONTACTO_ID','TITULO','NOMBRE','APELLIDO','created_at'],
                'relaciones' => [
                    'contacto' => ['Noportunidades','listaOportunidades']
                ]
            ];
            if ($request->exists('inicio')) {
                $inicio = str_replace('-', '', $request->input('inicio'));
                if ($request->exists('fin')) {
                    $fin = str_replace('-', '', $request->input('fin'));
                }
                else{
                    $fin = date('Ymd',time());
                }
                $dataDB = $this->clientes($columnas['contacto'],array($inicio,$fin));
            }
            else{
                $dataDB = $this->clientes($columnas['contacto']);
            } 

            $data = $this->formatearSalida('contacto',$columnas,$dataDB);

            $data = $this->ordenarPorColumna($data,'Noportunidades');

            // limitar a n resultados por defecto 10
            if ($request->exists('cantidad')) {
                $cantidad = $request->input('cantidad');
            }
            else{
                $cantidad = 10;
            }

            if ($reverse == false) {
                $data = array_slice($data, 0,$cantidad);
            }
            else{
                $cantidad = 0 - $cantidad;
                $data = array_slice($data, $cantidad);
            }
            
            $informe = array();
            foreach ($data as $registro) {
                array_push($informe, [$registro['nombre']]);
                foreach ($registro['listaOportunidades'] as $op) {
                    array_push($informe, array($op['titulo'],$op['fase'],'$'.$op['importe'],$op['cierre']));
                }
            }
            return $informe;
        }

        // obtener el request original para luego modificarlo a fin de que el api pueda 
        // utilizarlo
        private function clienteClasificacion($request)
        {
            $columnas = [
                'contacto' => ['CONTACTO_ID','TIPO','ORIGEN'],
                'relaciones' => [
                    'contacto' => ['ingresos']
                ]
            ];
            $informe = array();          
            // obtener los datos para /cliente/clasificacion
            if ($request->exists('inicio')) {
                $inicio = str_replace('-', '', $request->input('inicio'));
                if ($request->exists('fin')) {
                    $fin = str_replace('-', '', $request->input('fin'));
                }
                else{
                    $fin = date('Ymd',time());
                }
                $dataDB = $this->clientes($columnas['contacto'],array($inicio,$fin));
            }
            else{
                $dataDB = $this->clientes($columnas['contacto']);
            }
            $data = $this->formatearSalida('contacto',$columnas,$dataDB);
            // rescatar de la api los datos
            $busqueda = array('Anuncio','Folleto','Referencia de empleado','Sitio web','Anuncio via Email');
            array_push($informe, ['Origen']);
            foreach ($busqueda as $origen) {
                $conjunto = $this->buscarEnArreglo($data,'origen',$origen);
                array_push($informe,[$origen,count($conjunto),$this->restarElementos($conjunto,'ingresos','inversion')]);
    
            }
            $busqueda = array('Particular','Educacion','Gobierno','Empresa');
            array_push($informe, ['Tipo']);
            foreach ($busqueda as $tipo) {
                $conjunto = $this->buscarEnArreglo($data,'tipo',$tipo);
                array_push($informe,[$tipo,count($conjunto),$this->restarElementos($conjunto,'ingresos','inversion')]);
            }
            return $informe;
        }

        private function clienteGenerados($request)
        {
            // TODO : terminar
            $columnas = [
                'contacto' => ['CONTACTO_ID','TITULO','NOMBRE','APELLIDO','TIPO','ESTADO','ORIGEN','ESCLIENTE','created_at']
            ];
            if ($request->exists('inicio')) {
                $inicio = str_replace('-', '', $request->input('inicio'));
                if ($request->exists('fin')) {
                    $fin = str_replace('-', '', $request->input('fin'));
                }
                else{
                    $fin = date('Ymd',time());
                }
                $dataDB = $this->clientes($columnas['contacto'],array($inicio,$fin));
            }
            else{
                $dataDB = $this->clientes($columnas['contacto']);
            } 

            $informe = array();            
            $data = $this->formatearSalida('contacto',$columnas,$dataDB);

            // armar el informe
            foreach ($data as $registro) {
                $fila = [$registro['nombre'],$registro['tipo'],$registro['origen'],$registro['estado'],$registro['created']];
                array_push($informe, $fila);
            }

            return $informe;
        }
        private function clienteRelacion($request)
        {
            $columnas = [
                'contacto' => ['CONTACTO_ID','TITULO','NOMBRE','APELLIDO'],
                'relaciones' => [
                    'contacto' => ['ingresos','Noportunidades']
                ]   
            ];
            if ($request->exists('inicio')) {
                $inicio = str_replace('-', '', $request->input('inicio'));
                if ($request->exists('fin')) {
                    $fin = str_replace('-', '', $request->input('fin'));
                }
                else{
                    $fin = date('Ymd',time());
                }
                $dataDB = $this->clientes($columnas['contacto'],array($inicio,$fin));
            }
            else{
                $dataDB = $this->clientes($columnas['contacto']);
            }
            $data = $this->formatearSalida('contacto',$columnas,$dataDB);

            // crear informe 
            $informe = array();
            $data = $this->ordenarPorColumna($data,'Noportunidades');
            foreach ($data as $registro) {
                array_push($informe, array($registro['nombre'],$registro['Noportunidades'],$registro['ingresos'] - $registro['inversion']));
            }

            return $informe;            
        }

        /// oportunidades

        private function oportunidadPerdida ($request,$abierta=false)
        {
            $columnas = [
                'oportunidad' => ['OPORTUNIDAD_ID','CONTACTO_ID','TITULO','IMPORTE','created_at'],
                'relaciones' => [
                    'oportunidad' => ['cliente','url']
                ]
            ];
            if ($abierta == false) {
                $comparacion = '=';
            }
            else{
                $comparacion = '<>';
            }            
            if ($request->exists('inicio')) {
                $inicio = str_replace('-', '', $request->input('inicio'));
                if ($request->exists('fin')) {
                    $fin = str_replace('-', '', $request->input('fin'));
                }
                else{
                    $fin = date('Ymd',time());
                }

                $dataDB = Oportunidad::whereBetween('created_at' ,array($inicio,$fin))->
                where('Etapa',$comparacion,'Perdida')->get($columnas['oportunidad']);
            }
            else{
                $dataDB = Oportunidad::where('Etapa',$comparacion,'Perdida')->get($columnas['oportunidad']);
            }            

            $data = $this->formatearSalida('oportunidad',$columnas,$dataDB);

            // crear informe
            $informe = array();
            foreach ($data as $registro) {
                $formato = [$registro['cliente'],$registro['titulo'],'$'.$registro['importe'],
                $registro['created'],'<a href="'. $registro['url']. '">Editar</a>'];
                array_push($informe, $formato);
            }
            return $informe;
        }

        private function oportunidadPor($request,$orden)
        {
            $columnas = [
                'oportunidad' => ['OPORTUNIDAD_ID','CONTACTO_ID','TITULO','IMPORTE','ETAPA','created_at','PROBABILIDAD','TIPO'],
                'relaciones' => [
                    'oportunidad' => ['cliente','url','origen']
                ]
            ];   

            if ($request->exists('inicio')) {
                $inicio = str_replace('-', '', $request->input('inicio'));
                if ($request->exists('fin')) {
                    $fin = str_replace('-', '', $request->input('fin'));
                }
                else{
                    $fin = date('Ymd',time());
                }
                if ($orden == 'etapa') {
                    $dataDB = Oportunidad::orderBy('ETAPA')->whereBetween('created_at' ,array($inicio,$fin))->
                    where('Etapa','<>','Perdida')->get($columnas['oportunidad']);                    
                }
                else if ($orden == 'tipo') {
                    $dataDB = Oportunidad::orderBy('TIPO')->whereBetween('created_at' ,array($inicio,$fin))->
                    where('Etapa','<>','Perdida')->get($columnas['oportunidad']);                    
                }
                else{
                    $dataDB = Oportunidad::whereBetween('created_at' ,array($inicio,$fin))->
                    where('Etapa','<>','Perdida')->get($columnas['oportunidad']);
                }

            }
            else{
                if ($orden == 'etapa') {
                    $dataDB = Oportunidad::orderBy('ETAPA')->where('Etapa','<>','Perdida')->get($columnas['oportunidad']);
                }
                else if ($orden == 'tipo') {
                    $dataDB = Oportunidad::orderBy('TIPO')->where('Etapa','<>','Perdida')->get($columnas['oportunidad']);
                }            
                else{
                    $dataDB = Oportunidad::where('Etapa','<>','Perdida')->get($columnas['oportunidad']);
                }
            }
            // formatear salida
            $data = $this->formatearSalida('oportunidad',$columnas,$dataDB);
            // ordenar por el tipo deseado
            if ($orden == 'probabilidad') {
                $data = $this->ordenarPorColumna($data,$orden);
            }
            else if ($orden == 'origen') {
                $data = $this->ordenarPorColumna($data,$orden);
            }
            
            $informe = array();

            foreach ($data as $registro) {
                $formato = array($registro[$orden] ,$registro['cliente'],$registro['titulo'],$registro['etapa'],
                    $registro['importe'],$registro['created'],'<a href="'. $registro['url']. '">Editar</a>');
                array_push($informe, $formato);
            }

            return $informe;
        }

        private function oportunidadesProximos($request)
        {
            $columnas = [
                'oportunidad' => ['OPORTUNIDAD_ID','CONTACTO_ID','TITULO','ETAPA','CIERRE','created_at'],
                'relaciones' => [
                    'oportunidad' => ['cliente','url']
                ]
            ];              
            $dataDB = Oportunidad::orderBy('CIERRE')->where('Etapa','<>','Perdida')->get($columnas['oportunidad']);

            $data = $this->formatearSalida('oportunidad',$columnas,$dataDB);

            if ($request->exists('lapso')) {
                $data = $this->proximo($data,'cierre',$request->input('lapso'));    
            }
            else{
                $data = $this->proximo($data,'cierre',7);       
            }

            $informe = array();
            foreach ($data as $registro) {
                array_push($informe, array($registro['titulo'],$registro['etapa'],
                    $registro['cliente'],$registro['cierre'],'<a href="'. $registro['url']. '">Editar</a>'));
            }
            
            return $informe;
        }

        private function oportunidadesActuales($request,$tipo)
        {
            $columnas = [
                'oportunidad' => ['OPORTUNIDAD_ID','CONTACTO_ID','TITULO','ETAPA','CIERRE','IMPORTE'],
                'relaciones' => [
                    'oportunidad' => ['url','cliente']
                ]
            ];
            if ($tipo == 'mes') {
                $dataDB = Oportunidad::whereBetween('CIERRE',array($this->_data_first_month_day(),$this->_data_last_month_day()))->
                where('ETAPA','=','Completada')->get($columnas['oportunidad']);                
            }
            else{
                $dataDB = Oportunidad::where('CIERRE','=',date('Ymd',time()))->
                where('ETAPA','=','Completada')->get($columnas['oportunidad']);
            }

            $data = $this->formatearSalida('oportunidad',$columnas,$dataDB);

            $informe = array();

            foreach ($data as $registro) {
                array_push($informe, array($registro['titulo'],$registro['cliente'],
                    '$'.$registro['importe'],'<a href="'. $registro['url']. '">Editar</a>'));
            }

            return $informe;
        }

        private function prospectoClasificacion($request,$clasificacion)
        {
            $columnas = [
                'contacto' => ['CONTACTO_ID','TITULO','NOMBRE','APELLIDO','ORIGEN','TIPO','VALORACION','created_at','ESTADO','CALIFICACION'],
                'relaciones' => [
                    'contacto' => ['url']
                ]
            ];
            if ($request->exists('inicio')) {
                $inicio = str_replace('-', '', $request->input('inicio'));
                if ($request->exists('fin')) {
                    $fin = str_replace('-', '', $request->input('fin'));
                }
                else{
                    $fin = date('Ymd',time());
                }
                $dataDB = $this->contactos($columnas['contacto'],array($inicio,$fin));
            }
            else{
                $dataDB = $this->contactos($columnas['contacto']);
            }            

            $data = $this->formatearSalida('contacto',$columnas,$dataDB);

            $data = $this->ordenarPorColumna($data,$clasificacion);

            // armar el informe

            $informe = array();

            foreach ($data as $registro) {
                array_push($informe, array($registro[$clasificacion],$registro['nombre'],
                    $registro['estado'],$registro['calificacion'],$registro['valoracion'],
                    $registro['created'],'<a href="'. $registro['url']. '">Editar</a>' ));
            }

            return $informe;
        }

        /** Actual month last day **/
        private function _data_last_month_day() { 
          $month = date('m');
          $year = date('Y');
          $day = date("d", mktime(0,0,0, $month+1, 0, $year));

          return date('Ymd', mktime(0,0,0, $month, $day, $year));
        }

        /** Actual month first day **/
        private function _data_first_month_day() {
          $month = date('m');
          $year = date('Y');
          return date('Ymd', mktime(0,0,0, $month, 1, $year));
        }        

        private function proximo($arreglo,$campo,$rango)
        {
            // buscar los registros cuyo $campo este en un $rango proximo a la 
            // fecha actual
            $candidatos = array();
            $hoy = date_create(date('Y-m-d',time()));

            foreach ($arreglo as $registro) {
                // calcular la diferencia
                $fecha = date_create($registro[$campo]);
                $diferencia = date_diff($fecha,$hoy);
                if ($diferencia->days <= $rango && $diferencia->invert != 0) {
                    array_push($candidatos, $registro); 
                }
            }
            return $candidatos;

        }

        private function buscarEnArreglo($arreglo,$columna,$valor)
        {
            // buscar en un arreglo de arreglos aquellos en los que el valor de 
            // la $columna sea igual al $valor
            $coinciden = array();
            foreach ($arreglo as $elemento) {
                if ($elemento[$columna] == $valor) {
                    array_push($coinciden, $elemento);
                }
            }
            return $coinciden;
        }

        private function restarElementos($arreglo,$A,$B)
        {
            $resta = 0;
            foreach ($arreglo as $elemento) {
                $resta += $elemento[$A] - $elemento[$B];
            }
            return $resta;
        }

        private function ordenarPorColumna($arreglo,$columna)
        {
            for ($i=0; $i < count($arreglo); $i++) { 
                for ($x=0; $x < count($arreglo); $x++) { 
                    if ($arreglo[$i][$columna] > $arreglo[$x][$columna]) {
                        $temp = $arreglo[$x];
                        $arreglo[$x] = $arreglo[$i];
                        $arreglo[$i] = $temp; 
                    }
                }
            }
            return $arreglo;
        }
    }
 ?>