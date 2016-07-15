<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Mail;

use App\Tarea;
use App\User;

class SendEmailTarea extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:tareas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar los correos relacionados con las tareas';

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
        // obtener las tareas cuya notificacion esta activada y que su
        // plazo cierre el dia de hoy

        $candidatos = Tarea::where('VENCIMIENTO','=',date('Ymd',time()))
        ->where('NOTIFICACION','=',1)
        ->where('ESTADO','<>','Completada')->
        get(array('TAREA_ID','USUARIO_ID','TITULO','ASUNTO','CONTACTO_ID','DESCRIPCION','VENCIMIENTO','ESTADO'));

        // recorrer los resultados,armar los datos y enviar el correo

        $this->info($candidatos);

        if (count($candidatos) > 0) {
            foreach ($candidatos as $tarea) {
                // armar los datos
                $this->info($tarea);

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
                
                Mail::send('emails.tareanotificacion', $data, function ($message) use ($user) {

                    $message->from('crm@vantec.mx', 'CRM');
                
                    $message->to($user->email, $user->name);
            
                    $message->subject('Tarea proxima a cierre');
                
                    $message->priority(1);
                
                });

                $this->info('mensaje enviado a: ' . $user->email);           
            }            
        }

        // recordatorios programadas para el dia de hoy
        $hoy = date('Ymd',time());
        $inicio = date_create($hoy);
        $inicio = date_format($inicio,'YmdHis');
        $fin = date_create(date('Ymd',strtotime($hoy) + (24*60*60) ));
        $fin = date_format($fin,'YmdHis');

        $this->info($inicio);
        $this->info($fin);
        $candidatos = Tarea::whereBetween('FECHA_RECORDAR',array($inicio,$fin))
        ->where('ESTADO','<>','Completada')->where('RECORDAR','=','1')
        ->get(array('TAREA_ID','USUARIO_ID','TITULO','ASUNTO','CONTACTO_ID','DESCRIPCION','RECORDAR'));

        if (count($candidatos) > 0) {
            foreach ($candidatos as $tarea) {
                // armar los datos
                $this->info($tarea);

                $user = User::findOrFail($tarea->USUARIO_ID);

                $data = [
                    'titulo' => $tarea->TITULO,
                    'asunto' => $tarea->ASUNTO,
                    'vencimiento' => $tarea->VENCIMIENTO,
                    'descripcion' => $tarea->DESCRIPCION,
                    'cliente' => $tarea->contacto['TITULO'] .' '.
                    $tarea->contacto['NOMBRE'] . ' ' .  $tarea->contacto['APELLIDO'],
                    'estado' => $tarea->ESTADO,
                    'url' => url('/editar/tarea/'.$tarea->TAREA_ID)
                ];
                
                Mail::send('emails.tarearecordatorio', $data, function ($message) use ($user) {

                    $message->from('crm@vantec.mx', 'CRM');
                
                    $message->to($user->email, $user->name);
            
                    $message->subject('Recordatorio de tarea');
                
                    $message->priority(1);
                
                });
                // marcar como recordada
                $reg = Tarea::findOrFail($tarea->TAREA_ID);
                $reg->RECORDAR = 0;
                $reg->save();

                $this->info('mensaje enviado a: ' . $user->email);           
            }            
        }        




    }
}
