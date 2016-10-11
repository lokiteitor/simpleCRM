<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Contacto;
    use App\Campana;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;

    /**
    * Controlador para la seccion de clientes
    */
    class ClientesController extends Controller
    {

        static function buscarContacto($dato)
         {
             return Contacto::where('NOMBRE','LIKE','%'.$dato . '%')
             ->orWhere('APELLIDO','LIKE','%'.$dato . '%')
             ->orWhere('CONTACTO_ID','LIKE','%'.$dato . '%')->get();
         } 

        static function getCliente($id)
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

        public function listarClientes()
        {
           $data['usuario'] = Auth::user()->name;
           $data['sitio'] = "Lista de clientes";
           $data['titulo'] = "Clientes";
           return view('listaContactos', $data);            
        }

        public function crearCliente()
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Crear Cliente";
            $data['titulo'] = "Clientes";
            $data['edicion'] = false;
            $data['action'] = "/crear/cliente/";            
            return view("crearContacto",$data);
        }
        public function editarCliente($id)
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Editar Cliente";
            $data['titulo'] = "Clientes";
            $data['edicion'] = true;            
            return view("crearContacto",$data);            
        }

        public function detallesCliente($id)
        {
            $data['usuario'] = Auth::user()->name;
            $data['sitio'] = "Ver Cliente";
            $data['titulo'] = "Clientes";
            return view("detalleContacto",$data);            
        }        


        public function subirCliente(Request $request)
        {

            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
            $redirect = '/crear/cliente';
 
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
            }
            if ($request->has('_id')) {
                $redirect = '/editar/cliente/' . $request->input('_id');
            }

            return redirect($redirect)->withErrors($validador)->withInput();

   
        }
        public function obtenerCliente(Request $request)
        {
            $response = array();
            if ($request->exists('id')) {
                // obtener los datos de este contacto
                // el parametro es el limite superior de la consulta
                $formato = $this->getCliente($request->input('id'));
            }
            return $formato;  
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
            $registro->ESCLIENTE = true;
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


    }



 ?>