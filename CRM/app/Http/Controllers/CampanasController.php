<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Campana;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;

    /**
    * Controlador para la seccion de clientes
    */
    class CampanasController extends Controller
    {


        // buscar una campaña que coincida con un nombre
        static function buscarCampana($nombre)
        {
            return Campana::where('NOMBRE','LIKE',$nombre . '%')->where('ACTIVA','=','1')->get();
        }

        static function getCampana($id)
        {
            $data = Campana::find($id);

            $formato = [
                'nombre' => $data['NOMBRE'],
                'inicio' => $data['INICIO'],
                'finalizacion' => $data['FINALIZACION'],
                'activo' => $data['ACTIVA'],
                'estado' => $data['ESTADO'],
                'ingresos' => $data['INGRESOS_ESP'],
                'coste' => $data['PRESUPUESTO'],
                'real' => $data['COSTE'],
                'respuesta' => $data['RESPUESTA'],
                'descripcion' => $data['DESCRIPCION'],
                'tipo' => $data['TIPO']
            ];            
            return $formato;
        }

        public function listarCampanas()
        {
           $data['usuario'] = Auth::user()->name;
           $data['sitio'] = "Lista de campañas";
           $data['titulo'] = "Campañas";
           return view('listaCampanas', $data);            
        }

        public function crearCampana()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Crear Cliente";
            $data['titulo'] = "Campañas";
            $data['edicion'] = false;
            return view("crearCampana",$data);
        }
        public function editarCampana()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Crear Campaña";
            $data['titulo'] = "Campañas";
            $data['edicion'] = true;
            return view("crearCampana",$data);
        }
        public function detallesCampana()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Ver Campaña";
            $data['titulo'] = "Campañas";
            return view("detallesCampana",$data);
        }



        public function subirCampana(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();

            $validador = $this->validarFormulario($data);
            $redirect = '/crear/campana';
            if ($validador->passes()) {
                //  guardar en la base de datos
                if ($request->exists('_id')) {
                    $campana = Campana::find($request->input('_id'));
                }
                else{
                    $campana = new Campana;
                }
                $this->manipularModelo($campana,$request);
            }
            if ($request->exists('_id')) {
                $redirect = '/editar/campana/' . $request->input('_id');
            }

            return redirect($redirect)->withErrors($validador)->withInput();
        }

        public function obtenerCampana(Request $request)
        {
            $response = array();

            if ($request->exists('id')) {
                $formato = $this->getCampana($request->input('id'));
            }

            return $formato;
        }

        private function manipularModelo($campana,$request)
        {
            $campana->NOMBRE = $request->input('nombre');
            $campana->INICIO = $request->input('inicio');
            $campana->FINALIZACION = $request->input('finalizacion');
            if ($request->input('activo') == 'on') {
                $campana->ACTIVA = true;
            }                
            $campana->TIPO = $request->input('tipo');                
            $campana->ESTADO = $request->input('estado');
            $campana->INGRESOS_ESP = $request->input('ingresos');
            $campana->PRESUPUESTO = $request->input('coste');
            $campana->COSTE = $request->input('real');
            $campana->RESPUESTA = $request->input('respuesta');
            $campana->DESCRIPCION = $request->input('descripcion');
            $campana->save();                    
        }
        private function validarFormulario($data)
        {
            // reglas de validacion
            $reglas = array(
                    'nombre' => 'required',
                    'tipo' => 'required',
                    'otro' => 'required_if:tipo,Otro',
                    'estado' => 'required',
                    'inicio' => 'date_format:Y-m-d',
                    'finalizacion' => 'date_format:Y-m-d',
                    'ingresos' => 'regex:/^[0-9]+.[0-9]{2}$/',
                    'real' => 'regex:/^[0-9]+.[0-9]{2}$/',
                    'coste' => 'regex:/^[0-9]+.[0-9]{2}$/',                
   
                );

            $mensajes = array(
                'required' => 'Este campo es requerido',
                'regex' => 'El campo debe seguir el formato establecido',
                'required_with' => 'Los demas campos deben de estar señalados',
                'data_format' => 'La fecha debe estar en el campo prestablecido',
                'required_if' => 'Los demas campos deben de ser señalados'
                );

            $validador = Validator::make($data,$reglas,$mensajes);     

            return $validador;       
        }

    }
 ?>