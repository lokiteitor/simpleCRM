<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Evento;
use App\User;
use App\Tarea;
use Mail;


class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar los recordatorios de aquellas tareas,eventos...etc que se realizen hoy';

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
        //
        // obtener los eventos que se realizaran el dia de hoy 
        $candidatos = Evento::where('FECHA','=',date('Ymd',time()))
        ->get(array('EVENTO_ID','USUARIO_ID','TITULO','ASUNTO','UBICACION','DE','A','ALLDAY','CONTACTO_ID'));

        

        if (count($candidatos) > 0) {
            $this->info('Enviando correos de eventos');
            foreach ($candidatos as $evento) {
                // armar los datos
                $this->info($evento->EVENTO_ID);

                $user = User::findOrFail($evento->USUARIO_ID);

                $data = [
                    'titulo' => $evento->TITULO,
                    'asunto' => $evento->ASUNTO,
                    'cliente' => $evento->contacto['TITULO'] .' '.
                    $evento->contacto['NOMBRE'] . ' ' .  $evento->contacto['APELLIDO'],
                    'url' => url('/editar/evento/'.$evento->EVENTO_ID),
                    'ubicacion' => $evento->UBICACION,
                    'descripcion' => $evento->DESCRIPCION
                ];

                if ($evento->ALLDAY = true) {
                    $data['hora'] = 'Todo el dia';
                }
                else{
                    $data['hora'] = $evento->DE . ' ' .$evento->A;
                }
                
                $this->enviar($data,'Evento proximo a realizarse','emails.eventonotificacion',$user);

                $this->info('mensaje enviado a: ' . $user->email);            
            }
            
        }        

        // obtener las tareas cuya notificacion esta activada y que su
        // plazo cierre el dia de hoy

        $candidatos = Tarea::where('VENCIMIENTO','=',date('Ymd',time()))
        ->where('NOTIFICACION','=',1)
        ->where('ESTADO','<>','Completada')->
        get(array('TAREA_ID','USUARIO_ID','TITULO','ASUNTO','CONTACTO_ID','DESCRIPCION','VENCIMIENTO','ESTADO'));

        // recorrer los resultados,armar los datos y enviar el correo


        if (count($candidatos) > 0) {
            $this->info('Enviando correos de tareas');
            foreach ($candidatos as $tarea) {
                // armar los datos
                $this->info($tarea->EVENTO_ID);

                $user = User::findOrFail($tarea->USUARIO_ID);

                $data = [
                    'titulo' => $tarea->TITULO,
                    'asunto' => $tarea->ASUNTO,
                    'vencimiento' => strval($tarea->VENCIMIENTO),
                    'descripcion' => $tarea->DESCRIPCION,
                    'cliente' => $tarea->contacto['TITULO'] .' '.
                    $tarea->contacto['NOMBRE'] . ' ' .  $tarea->contacto['APELLIDO'],
                    'estado' => $tarea->ESTADO,
                    'url' => url('/editar/tarea/'.$tarea->TAREA_ID)
                ];
                
                $this->enviar($data,'Tarea proxima a cierre','emails.tareanotificacion',$user);

                $this->info('mensaje enviado a: ' . $user->email);           
            }            
        }
    }

    private function enviar($data,$asunto,$vista,$user)
    {
        Mail::send($vista, $data, function ($message) use ($user,$asunto) {

            $message->from('crm@vantec.mx', 'CRM');
        
            $message->to($user->email, $user->name);
    
            $message->subject($asunto);
        
            $message->priority(1);
        
        });
        
    }
}
