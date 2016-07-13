<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Oportunidad;
    use App\Contacto;
    use App\Campana;    
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;
    /**
    * Controlador para la seccion de clientes
    */
    class OportunidadesController extends Controller
    {

        public function listarOportunidades()
        {
           $data['usuario'] = Auth::user()->name;
           $data['sitio'] = "Lista de Oportunidades";
           $data['titulo'] = "Oportunidades";
           return view('listaOportunidades', $data);            
        }

        public function crearOportunidad()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Crear Oportunidad";
            $data['titulo'] = "Oportunidades";
            $data['edicion'] = false;
            return view("crearOportunidad",$data);
        }

        public function editarOportunidad()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Editar Oportunidad";
            $data['titulo'] = "Oportunidades";
            $data['edicion'] = true;
            return view("crearOportunidad",$data);
        }

        public function subirOportunidad(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
            // reglas de validacion
            $validador = $this->validarFormulario($data);
            $redirect = "/crear/oportunidad";
            if ($validador->passes()) {
                //  guardar en la base de datos
                if ($request->exists('_id')) {
                    $oportunidad = Oportunidad::find($request->input('_id'));                    
                }
                else{
                    $oportunidad = new Oportunidad;
                }
                $this->manipularModelo($oportunidad,$request);                
            }
            if ($request->exists('_id')) {
                $redirect = '/editar/oportunidad/' . $request->input('_id');
            }
            return redirect($redirect)->withErrors($validador)->withInput();
        }

        public function obtenerOportunidad(Request $request)
        {
            $response = array();
            if ($request->exists('id')) {
                $data = Oportunidad::find($request->input('id'));

                $formato = [
                    'titulo' => $data['TITULO'],
                    'cliente' => $data->contacto['CONTACTO_ID'] . '-' . $data->contacto['TITULO']
                     .' '.$data->contacto['NOMBRE'] . ' ' .  $data->contacto['APELLIDO'],
                    'campaña' => $data->campana['CAMPANA_ID'] . '-' .  $data->campana['NOMBRE'],
                    'tipo' => $data['TIPO'],
                    'presupuesto' => $data['PRESUPUESTO'],
                    'etapa' => $data['ETAPA'],
                    'probabilidad' => $data['PROBABILIDAD'],
                    'factura' => $data['FACTURA'],
                    'importe' => $data['IMPORTE'],
                    'cierre' => $data['CIERRE'],
                    'descripcion' => $data['INFORMACION'],
                    'inversion' => $data['INVERSION']
 
                ];
            }
            return $formato;
        }

        private function validarFormulario($data)
        {
            $reglas = array(
                    'titulo' => 'required',
                    'tipo' => 'required',
                    'etapa' => 'required',
                    'cierre' => 'date_format:Y-m-d',
                    'probabilidad' => 'max:100|regex:/^[0-9]{3}$/',
                    'importe' => 'regex:/^[0-9]+.[0-9]{2}$/',
                    'inversion' => 'regex:/^[0-9]+.[0-9]{2}$/',                
   
                );

            $mensajes = array(
                'required' => 'Este campo es requerido',
                'regex' => 'El campo debe seguir el formato establecido',
                'required_with' => 'Los demas campos deben de estar señalados',
                'data_format' => 'La fecha debe estar en el campo prestablecido',
                'required_if' => 'Los demas campos deben de ser señalados',
                'max' => 'El campo excede el limite establecido'
                );

            return Validator::make($data,$reglas,$mensajes);            
        }

        private function manipularModelo($oportunidad,$request)
        {
            $oportunidad->TITULO = $request->input('titulo');

            $oportunidad->USUARIO_ID = Auth::user()->id;
           
            $oportunidad->TIPO = $request->input('tipo');
            if ($request->input('presupuesto') == 'on') {
                $oportunidad->PRESUPUESTO = true;
            }
            $oportunidad->ETAPA = $request->input('etapa');
            if ($request->exists('probabilidad')) {
                $oportunidad->PROBABILIDAD = $request->input('probabilidad');
            }
            if ($request->exists('factura')) {
                $oportunidad->FACTURA = $request->input('factura');
            }
            if ($request->exists('importe')) {
                $oportunidad->IMPORTE = $request->input('importe');
            }
            if ($request->exists('inversion')) {
                $oportunidad->INVERSION = $request->input('inversion');
            }            
            $oportunidad->CIERRE = $request->input('cierre');
            if ($request->exists('descripcion')) {
                $oportunidad->INFORMACION = $request->input('descripcion');
            }                
            $oportunidad->save();    

            
            if ($request->exists('cliente')) {
                $id = explode('-', $request->input('cliente'));
                $cliente_id = $id[0];
                $cliente = Contacto::find($cliente_id);

                if ($cliente) {
                    $oportunidad->CONTACTO_ID = $cliente->CONTACTO_ID;
                    // si el contacto es un prospecto convertirlo a cliente
                    if ($cliente->ESCLIENTE == false) {
                        $cliente->ESCLIENTE = true;

                    }
                    $cliente->save();
                }                
            }
            if ($request->exists('campaña')) {

                $id = explode('-', $request->input('campaña'));
                $campana_id = $id[0];
                $campana = Campana::find($campana_id);


                if ($campana) {
                    $oportunidad->CAMPANA_ID = $campana->CAMPANA_ID;
                }
            }     
            $oportunidad->save();
        }

    }
 ?>