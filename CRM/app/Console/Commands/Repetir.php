<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Tarea;
use App\Evento;

class Repetir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repeat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear los eventos que se tengan que repetir el dia de hoy';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //los eventos y las tareas se repiten cada tantos dias entre un lapso
        // especificado por el usuario por lo que para evitar problemas 
        // todos los dias el servidor debe revisar que eventos se repitiran 
        // en la fecha actual y creara el evento sencillo sin campos de repeticion
        // heredando las demas configuraciones del padre

        // recorrer en busca de candidatos
        $candidatos = Tarea::where('REPETIR','=','1')->where('REPETIR_INICIO', '<=',date('Ymd',time()))
        ->where('REPETIR_FIN','>=',date('Ymd',time()))->get(array('TAREA_ID','REPETIR_INICIO','REPETIR_FIN','REPETIR_DIAS','USUARIO_ID'));

        foreach ($candidatos as $registro) {
            // comprobar si el dia de hoy entra entre los lapsos de repeticion
            // calcular los lapsos
            $lapsos = $this->getLapsos($registro);
            // entre estos lapsos determinar si alguno coincide con la fecha actual
            $hoy = date('Y-m-d',time());
            $this->info('hoy ' . $hoy);
            foreach ($lapsos as $lapso) {
                if ($hoy == $lapso) {
                    $this->info('coincide ' . $lapso);
                    // crear la tarea como un clon del padre pero modificando los
                    // valores de repeticion
                    
                    $padre = Tarea::findOrFail($registro->TAREA_ID);
                    $hijo = new Tarea;                    
                    $hijo->USUARIO_ID = $padre->usuario->id;                    
                    $hijo->TITULO = $padre->TITULO;
                    $hijo->ASUNTO = $padre->ASUNTO;
                    $hijo->CONTACTO_ID = $padre->contacto->CONTACTO_ID;                    
                    // reiniciar el estado
                    $hijo->ESTADO = 'Sin Empezar';
                    $hijo->PRIORIDAD = $padre->PRIORIDAD;
                    $hijo->NOTIFICACION = $padre->NOTIFICACION;
                    $hijo->DESCRIPCION = $padre->DESCRIPCION;
                    //desactivar la repeticion y el recordatorio
                    $hijo->RECORDAR = false;
                    $hijo->REPETIR = false;
                    //vencimiento
                    //el vencimiento es el dia de hoy
                    $hijo->VENCIMIENTO = date('Y-m-d',time());                    
                    $hijo->save();
                    $this->info('tarea creada id: ' . $hijo->TAREA_ID);
                }
            }            
        }
        $this->info('EVENTOS');
        //eventos 
        $candidatos = Evento::where('REPETIR','=','1')->where('REPETIR_INICIO', '<=',date('Ymd',time()))
        ->where('REPETIR_FIN','>=',date('Ymd',time()))->get(array('EVENTO_ID','REPETIR_INICIO','REPETIR_FIN','REPETIR_DIAS','USUARIO_ID'));    


        foreach ($candidatos as $registro) {
            $lapsos = $this->getLapsos($registro);
            // entre estos lapsos determinar si alguno coincide con la fecha actual
            $hoy = date('Y-m-d',time());
            $this->info('hoy ' . $hoy);
            foreach ($lapsos as $lapso) {
                if ($hoy == $lapso) {
                    $this->info('coincide ' . $lapso);
                    // crear la tarea como un clon del padre pero modificando los
                    // valores de repeticion
                    
                    $padre = Evento::findOrFail($registro->EVENTO_ID);
                    $hijo = new Evento;

                    $hijo->USUARIO_ID = $padre->usuario->id;                    
                    $hijo->TITULO = $padre->TITULO;
                    $hijo->ASUNTO = $padre->ASUNTO;
                    $hijo->UBICACION = $padre->UBICACION;
                    $hijo->FECHA = date('Y-m-d',time());                    
                    $hijo->DE = $padre->DE;
                    $hijo->A = $padre->A;
                    $hijo->ALLDAY = $padre->ALLDAY;                    
                    $hijo->CONTACTO_ID = $padre->contacto->CONTACTO_ID;                    
                    $hijo->PARTICIPANTES = $padre->PARTICIPANTES;
                    $hijo->DESCRIPCION = $padre->DESCRIPCION;
                    //desactivar la repeticion y el recordatorio
                    $hijo->RECORDAR = false;
                    $hijo->REPETIR = false;
                    //vencimiento
                    //el vencimiento es el dia de hoy
                    $hijo->save();
                    $this->info('tarea creada id: ' . $hijo->EVENTO_ID);
                }
            }             
                
        }    
    }

    private function getLapsos($registro)
    {

        $inicio = date_create($registro->REPETIR_INICIO);
        $fin = date_create($registro->REPETIR_FIN);
        $intervalo = date_diff($inicio,$fin);
        $lapsos = array();

        if ($intervalo->invert != 1) {
            $diff = $intervalo->format('%a');
            $this->info($diff);
            if ($diff > 0 && ($diff/$registro->REPETIR_DIAS) > 0) {
                $limite = strtotime($registro->REPETIR_FIN);                
                $epoch_inicio = strtotime($registro->REPETIR_INICIO);
                for ($i=1; $i <= ($diff/$registro->REPETIR_DIAS); $i++) { 
                    //calcular los lapsos
                    
                    
                    $lapso = $epoch_inicio + (($registro->REPETIR_DIAS * $i) * 24*60*60);
                    if ($lapso <= $limite) {

                        array_push($lapsos, date('Y-m-d',$lapso));                      
                    }

                }                    
            }
        }        
        return $lapsos;
        
    }
}
