<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunidad extends Model
{
    //modelo asociado a tabla OPORTUNIDAD
    protected $table = 'OPORTUNIDAD';
    protected $primaryKey = 'OPORTUNIDAD_ID';    

    // un contacto puede tener muchas oportunidades
    public function contacto()
    {
        return $this->belongsTo('App\Contacto','CONTACTO_ID');
    }
    public function campana()
    {
        // una campaña puede tener muchas oportunidades
        return $this->belongsTo('App\Campana','CAMPANA_ID');
    }
    public function usuario()
    {
        return $this->belongsTo('App\User','id','USUARIO_id');
    }        
}
