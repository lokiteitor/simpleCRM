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
            if ($request->input('here') == '/ver/prospectos') {
                // el parametro es el limite superior de la consulta
                $data = Contacto::orderBy($request->input('orderby'),'asc')
                ->where('ESCLIENTE','=','0')->skip($request->input('pagina')-10)->take(10)->get();
            }


            return $data;   

        }


    }



 ?>