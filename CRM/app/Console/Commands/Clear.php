<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Campana;
use App\Oportunidad;
use App\Tarea;
use App\Evento;

class Clear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpia los registros cuya fecha de vencimiento a llegado';

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
        // buscar campañas cuya fecha de finalizacion llego

        $obsoletos = Campana::where('FINALIZACION','<=',date('Ymd',time()))
        ->where('ACTIVA','=','1')->get();

        // marcarlas como inactivas
        $this->info('Campañas');
        foreach ($obsoletos as $registro) {
            $campana = Campana::find($registro->CAMPANA_ID);
            $campana->ACTIVA = 0;
            $campana->save();
            $this->info($campana->CAMPANA_ID);
        }

        // buscar oportunidad con hoy como fecha de cierre

        $obsoletos = Oportunidad::where('CIERRE','<=',date('Ymd',time()))
        ->where('ETAPA','<>','Perdida')->get(array('OPORTUNIDAD_ID'));
        $this->info('Oportunidades');
        foreach ($obsoletos as $registro) {
            $oportunidad = Oportunidad::find($registro->OPORTUNIDAD_ID);
            $oportunidad->ETAPA = 'Perdida';
            $oportunidad->save();
            $this->info($oportunidad->OPORTUNIDAD_ID);
        }

        // tareas

        $obsoletos = Tarea::where('VENCIMIENTO','<=',date('Ymd',time()))
        ->where('ESTADO','<>','Completada')->where('ESTADO','<>','Cancelada')
        ->get(array('TAREA_ID'));
        $this->info('tareas');
        foreach ($obsoletos as $registro) {

            $tarea = Tarea::find($registro->TAREA_ID);
            $tarea->ESTADO = 'Cancelada';
            $tarea->save();
            $this->info($tarea->TAREA_ID);
        }
    }
}
