<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    //modelo asociado a tabla CONTACTO
    protected $table = 'CONTACTO';
    protected $primaryKey = 'CONTACTO_ID';
    
    public function campana()
    {
        return $this->belongsTo('App\Campana','CAMPANA_ID');
    }

    public function oportunidades()
    {
        return $this->hasMany('App\Oportunidad','CONTACTO_ID');
    }
    public function tareas()
    {
        return $this->hasMany('App\Tarea','CONTACTO_ID');
    }
    public function eventos()
    {
        return $this->hasMany('App\Evento','CONTACTO_ID');
    }

}
