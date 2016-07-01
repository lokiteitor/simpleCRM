<?php 

    namespace App\Http\Controllers;
    use Validator;
    use App\Campana;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    /**
    * Controlador para la seccion de clientes
    */
    class CampanasController extends Controller
    {

        public function listarCampanas()
        {
           $data['usuario'] = "Administrador";
           $data['sitio'] = "Lista de campañas";
           $data['titulo'] = "Campañas";
           return view('listaCampanas', $data);            
        }

        public function crearCampana()
        {
            $data['usuario'] = "Administrador";
            $data['sitio'] = "Crear Cliente";
            $data['titulo'] = "Campañas";
            $data['edicion'] = false;
            return view("crearCampana",$data);
        }

        public function subirCampana(Request $request)
        {
            // obtener los datos del formulario, validarlos e insertarlos en la
            // base de datos
            $data = $request->all();
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

            if ($validador->passes()) {
                //  guardar en la base de datos
                $campana = new Campana;
                $campana->NOMBRE = $request->input('nombre');
                $campana->INICIO = $request->input('inicio');
                $campana->FINALIZACION = $request->input('finalizacion');
                if ($request->input('activo') == 'on') {
                    $campana->ACTIVA = true;
                }                
                $campana->TIPO = $request->input('tipo');                
                $campana->ESTADO = $request->input('estado');
                $campana->INGRESOS_ESP = $request->input('ingresos');
                $campana->PRESUPUESTO = $request->input('presupuesto');
                $campana->COSTE = $request->input('coste');
                $campana->RESPUESTA = $request->input('respuesta');
                $campana->DESCRIPCION = $request->input('descripcion');


                $campana->save();        
            }
            return redirect('/crear/campana')->withErrors($validador)->withInput();
        }
    }
 ?>