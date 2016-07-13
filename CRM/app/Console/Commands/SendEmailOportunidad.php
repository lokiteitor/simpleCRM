<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Oportunidad;
use Mail;
use App\User;

class SendEmailOportunidad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:oportunidad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia los correos relacionados a las oportunidades';

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
        //realiza un recorrido de todas las oportunidades que cierran en los 
        // proximos 3 dias
        $limite = date('Ymd',time() - (3 * 24 * 60 * 60));
        $hoy = date('Ymd',time());

        $candidatos = Oportunidad::whereBetween('CIERRE',array($limite,$hoy))
        ->where('ETAPA','<>','Perdida')
        ->get(array('OPORTUNIDAD_ID','USUARIO_ID','CONTACTO_ID','TITULO','CIERRE','ETAPA'));

        // luego con los candidatos recorrer uno a uno para posteriormente 
        // enviar algun correo al usuario dueño de la oportunidad
        $this->info($candidatos);

        if (count($candidatos) > 0) {

            foreach ($candidatos as $oportunidad) {
                // armar los datos
                $this->info($oportunidad);

                $user = User::findOrFail($oportunidad->USUARIO_ID);

                $data = [
                    'titulo' => $oportunidad->TITULO,
                    'cierre' => strval($oportunidad->CIERRE),
                    'cliente' => $oportunidad->contacto['TITULO'] .' '.
                    $oportunidad->contacto['NOMBRE'] . ' ' .  $oportunidad->contacto['APELLIDO'],
                    'etapa' => $oportunidad->ETAPA,
                    'url' => url('/editar/oportunidad/'.$oportunidad->OPORTUNIDAD_ID)
                ];
                
                Mail::send('emails.oportunidadreminder', $data, function ($message) use ($user) {

                    $message->from('crm@vantec.mx', 'CRM');
                
                    $message->to($user->email, $user->name);
            
                    $message->subject('Oportunidad proxima a cierre');
                
                    $message->priority(1);
                
                });

                $this->info('mensaje enviado a: ' . $user->email);            
            }
            
        }

        

    }
}
