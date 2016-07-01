<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Oportunidad;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    /**
    * Controlador para la seccion de clientes
    */
    class OportunidadesController extends Controller
    {

        public function listarOportunidades()
        {
           $data['usuario'] = "Administrador";
           $data['sitio'] = "Lista de Oportunidades";
           $data['titulo'] = "Oportunidades";
           return view('listaOportunidades', $data);            
        }

        public function crearOportunidad()
        {
            $data['usuario'] = "Administrador";
            $data['sitio'] = "Crear Oportunidad";
            $data['titulo'] = "Oportunidades";
            $data['edicion'] = false;
            return view("crearOportunidad",$data);
        }

        public function subirOportunidad(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
            // reglas de validacion
            $reglas = array(
                    'titulo' => 'required',
                    'tipo' => 'required',
                    'etapa' => 'required',
                    'cierre' => 'date_format:Y-m-d',
                    'probabilidad' => 'regex:/^[0-9]{3}.[0-9]$/',
                    'importe' => 'regex:/^[0-9]+.[0-9]{2}$/',
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

            if ($validador->passes()) {
                //  guardar en la base de datos
                $oportunidad = new Oportunidad;
                $oportunidad->TITULO = $request->input('titulo');

                // TODO : insertar el id del usuario actual
                $oportunidad->USUARIO_ID = 1;

                // TODO : obtener el id de contacto a partir de su nombre
                if ($request->exists('buscar-cliente')) {
                    $oportunidad->CONTACTO_ID = 1;             
                }
                if ($request->exists('buscar-campaña')) {
                    $oportunidad->CAMPANA_ID = $request->input('buscar-campaña');                    
                }                
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
                $oportunidad->CIERRE = $request->input('cierre');
                if ($request->exists('descripcion')) {
                    $oportunidad->INFORMACION = $request->input('descripcion');
                }                

                $oportunidad->save();        
            }
            return redirect('/crear/oportunidad')->withErrors($validador)->withInput();
        }
    }
 ?>