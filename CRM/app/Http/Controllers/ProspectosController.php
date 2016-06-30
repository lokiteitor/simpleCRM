<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    /**
    * Controlador para la seccion de prospectos
    */
    class ProspectosController extends Controller
    {

        public function listarProspectos()
        {
           $data['usuario'] = "Administrador";
           $data['sitio'] = "Lista de prospectos";
           $data['titulo'] = "Prospectos";
           return view('listaClientes', $data);            
        }

        public function crearProspecto()
        {
            $data['usuario'] = "Administrador";
            $data['sitio'] = "Crear Prospecto";
            $data['titulo'] = "Prospectos";
            $data['edicion'] = false;
            $data['action'] = "/crear/prospecto/";            
            return view("crearCliente",$data);
        }

        public function subirProspecto(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
            // reglas de validacion
            $reglas = array(
                    'nombre' => 'required',
                    'apellidos' => 'required',
                    'telefono' =>  array('regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/'),
                    'celular' => array('regex:/^[0-9]{5}-[0-9]{3}-[0-9]{4}$/'),
                    'web'  => 'url',
                    'correo' => 'email',
                    'calle' => 'required_with:numero,colonia',
                    'numero' => 'integer|required_with:calle,colonia',
                    'colonia' => 'required_with:calle,numero',
                    'cpostal' => 'integer'
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

            if ($validador->passes()) {
                //  guardar en la base de datos
                $contacto = new Contacto;
                $contacto->TITULO = $request->input('sexo');
                $contacto->NOMBRE = $request->input('nombre');
                $contacto->APELLIDOS = $request->input('apellidos');
                
                if ($request->exists('telefono')) {
                    $contacto->TELEFONO = $request->input('telefono');
                }
                if ($request->exists('celular')) {
                    $contacto->CELULAR = $request->input('celular');
                }
                $contacto->TIPO = $request->input('tipo');
                $contacto->ORIGEN = $request->input('origen');
                if ($request->input('atiende-correo') == 'on') {
                    $contacto->AT_CORREO = true;
                }
                if ($request->exists('empresa')) {
                    $contacto->EMPRESA = $request->input('empresa');;
                }
                if ($request->exists('web')) {
                    $contacto->WEB = $request->input('web');
                }
                if ($request->exists('correo')) {
                    $contacto->CORREO = $request->input('correo');
                }
                $contacto->estado = $request->input('estado');
                $contacto->CALIFICACION = $request->input('calificacion');
                $contacto->VALORACION = $request->input('valoracion');
                if ($request->exists('campana')) {
                    $contacto->CAMPANA = $request->input('campana');
                }
                if ($request->exists('calle')) {
                    $contacto->CALLE = $request->input('calle');
                }
                if ($request->exists('numero')) {
                    $contacto->NUM_EXT = $request->input(numero);
                }
                if ($request->exists('colonia')) {
                    $contacto->COLONIA = $request->input(colonia);
                }
                if ($request->exists('cpostal')) {
                    $contacto->CPOSTAL = $request->input(cpostal);
                }
                if ($request->exists('descripcion')) {
                    $contacto->DESCRIPCION = $request->input(descripcion);
                }
                $contacto->save();        
            }
            return redirect('/crear/prospecto')->withErrors($validador)->withInput();
        }


    }



 ?>