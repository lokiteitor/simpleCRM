<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Contacto;
    use App\Campana;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;

    /**
    * Controlador para la seccion de prospectos
    */
    class ProspectosController extends Controller
    {

        static function buscarProspecto($dato)
         {  
            $dato = strtoupper($dato);
             return Contacto::where('NOMBRE','LIKE','%'.$dato . '%')
             ->orWhere('APELLIDO','LIKE','%'.$dato . '%')
             ->orWhere('CONTACTO_ID','LIKE','%'.$dato . '%')->get();
         } 


        // obtener los datos del prospecto especifico
        static function getProspecto($id)
        {
            $data = Contacto::find($id);
            $formato = [
                'sexo'=> $data['TITULO'],
                'nombre' => $data['NOMBRE'],
                'apellidos' => $data['APELLIDO'],
                'telefono' => $data['TELEFONO'],
                'celular' => $data['CELULAR'],
                'origen' => $data['ORIGEN'],
                'tipo' => $data['TIPO'],
                'atiende-correo' => $data['AT_CORREO'],
                'empresa' => $data['EMPRESA'],
                'web' => $data['WEB'],
                'correo' => $data['CORREO'],
                'estado' => $data['ESTADO'],
                'calificacion' => $data['CALIFICACION'],
                'valoracion' => $data['VALORACION'],
                'campaña' => $data->campana['CAMPANA_ID'] . '-' . $data->campana['NOMBRE'],
                'calle' => $data['CALLE'],
                'colonia' => $data['COLONIA'],
                'cpostal' => $data['CPOSTAL'],
                'numero' => $data['NUM_EXT'],
                'descripcion' => $data['DESCRIPCION']
            ];            
            return $formato;
        }

        public function listarProspectos()
        {
           $data['usuario'] = Auth::user()->name;
           $data['sitio'] = "Lista de prospectos";
           $data['titulo'] = "Prospectos";
           return view('listaClientes', $data);            
        }

        public function crearProspecto()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Crear Prospecto";
            $data['titulo'] = "Prospectos";
            $data['edicion'] = false;
            $data['action'] = "/crear/prospecto/";     
            return view("crearCliente",$data);
        }

        public function editarProspecto($id)
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Editar Prospecto";
            $data['titulo'] = "Prospectos";
            $data['edicion'] = true;            
            return view("crearCliente",$data);            
        }
        public function detallesProspecto($id)
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Ver Prospecto";
            $data['titulo'] = "Prospectos";
            return view("detalleCliente",$data);            
        }

        public function subirProspecto(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
            $redirect = '/crear/prospecto';
            $flags = array();
 
            $validador = $this->validarFormulario($data);
            if ($validador->passes()) {
                //  guardar en la base de datos
                if ($request->has('_id')) {
                    $contacto = Contacto::find($request->input('_id'));
                    
                }
                else{
                    $contacto = new Contacto;    
                }
                
                $this->manipularModelo($contacto,$request);
                $flags['isok'] = true;
            }
            else{
                $flags['isok'] = false;
            }
            if ($request->has('_id')) {
                $redirect = '/editar/prospecto/' . $request->input('_id');
            }

            return redirect($redirect)->withInput()->withErrors($validador);
        }



        public function obtenerProspecto(Request $request)
        {
            $response = array();
            if ($request->exists('id')) {
                // obtener los datos de este contacto
                // el parametro es el limite superior de la consulta
                $formato = $this->getProspecto($request->input('id'));
            }
            return $formato;  
        }

        private function validarFormulario($data)
        {
           // reglas de validacion
            $reglas = array(
                    'nombre' => 'required',
                    'apellidos' => 'required',
                    'correo' => 'email',
                );

            $mensajes = array(
                'required' => 'Este campo es requerido',
                'alpha' => 'El campo debe contener solo caracteres alfabeticos',
                'alpha_num' => 'El campo debe contener solo caracteres alfanumericos',
                'regex' => 'El campo debe seguir el formato establecido',
                'url' => 'El campo debe de contener una url valida',
                'email' => 'El campo debe contener una direccion de correo valida',
                'required_with' => 'Los demas campos deben de estar señalados'
                );

            $validador = Validator::make($data,$reglas,$mensajes);

            return $validador;
            
        }

        private function manipularModelo($registro,$request)
        {
            
            $registro->TITULO = $request->input('sexo');
            $registro->NOMBRE = $request->input('nombre');
            $registro->APELLIDO = $request->input('apellidos');
            
            if ($request->exists('telefono')) {
                $registro->TELEFONO = $request->input('telefono');
            }
            if ($request->exists('celular')) {
                $registro->CELULAR = $request->input('celular');
            }
            $registro->TIPO = $request->input('tipo');
            $registro->ORIGEN = $request->input('origen');
            if ($request->input('atiende-correo') == 'on') {
                $registro->AT_CORREO = true;
            }
            if ($request->exists('empresa')) {
                $registro->EMPRESA = $request->input('empresa');;
            }
            if ($request->exists('web')) {
                $registro->WEB = $request->input('web');
            }
            if ($request->exists('correo')) {
                $registro->CORREO = $request->input('correo');
            }
            $registro->estado = $request->input('estado');
            $registro->CALIFICACION = $request->input('calificacion');
            $registro->VALORACION = $request->input('valoracion');
            if ($request->exists('calle')) {
                $registro->CALLE = $request->input('calle');
            }
            if ($request->exists('numero')) {
                $registro->NUM_EXT = $request->input('numero');
            }
            if ($request->exists('colonia')) {
                $registro->COLONIA = $request->input('colonia');
            }
            if ($request->exists('cpostal')) {
                $registro->CPOSTAL = $request->input('cpostal');
            }
            if ($request->exists('descripcion')) {
                $registro->DESCRIPCION = $request->input('descripcion');
            }
            $registro->save();                

            if ($request->exists('campaña')) {
                // buscar el id de la campaña
                $id = explode('-',$request->input('campaña'));
                $campana_id = $id[0];
                $campaña = Campana::find($campana_id);

                if ($campaña) {
                    $registro->CAMPANA_ID = $campaña->CAMPANA_ID;
                }
            }
            $registro->save();            
        }

    }



 ?>