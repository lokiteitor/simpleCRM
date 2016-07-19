<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Evento;
use App\User;
use Mail;

class SendEmailEvento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:evento';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar los correos relacionados con los correos';

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


        // obtener los eventos cuyo recordatorio es hoy
        $hoy = date('YmdHis',time());
        $inicio = date_create($hoy);
        $inicio = date_format($inicio,'YmdHis');
        $fin = date_create(date('YmdHis',strtotime($hoy) + (5*60) ));
        $fin = date_format($fin,'YmdHis');

        $this->info($inicio);
        $this->info($fin);
        $candidatos = Evento::whereBetween('FECHA_RECORDAR',array($inicio,$fin))->where('RECORDAR','=','1')
        ->get(array('EVENTO_ID','USUARIO_ID','TITULO','ASUNTO','UBICACION','DE','A','ALLDAY','CONTACTO_ID','DESCRIPCION','RECORDAR'));

        if (count($candidatos) > 0) {

            foreach ($candidatos as $evento) {
                // armar los datos
                $this->info($evento->EVENTO_ID);

                $user = User::findOrFail($evento->USUARIO_ID);

                $data = [
                    'titulo' => $evento->TITULO,
                    'asunto' => $evento->ASUNTO,
                    'cliente' => $evento->contacto['TITULO'] .' '.
                    $evento->contacto['NOMBRE'] . ' ' .  $evento->contacto['APELLIDO'],
                    'url' => url('/editar/evento/'. $evento->EVENTO_ID),
                    'ubicacion' => $evento->UBICACION,
                    'descripcion' => $evento->DESCRIPCION
                ];

                if ($evento->ALLDAY = true) {
                    $data['hora'] = 'Todo el dia';
                }
                else{
                    $data['hora'] = $evento->DE . ' ' .$evento->A;
                }
                
                Mail::send('emails.eventonotificacion', $data, function ($message) use ($user) {

                    $message->from('crm@vantec.mx', 'CRM');
                
                    $message->to($user->email, $user->name);
            
                    $message->subject('recordatorio de evento');
                
                    $message->priority(1);
                
                });

                // marcar el recordatorio como desactivado
                $reg = Evento::findOrFail($evento->EVENTO_ID);
                $reg->RECORDAR = 0;
                $reg->save();

                $this->info('mensaje enviado a: ' . $user->email);            
            }
            
        }  




    }
}
