<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campana extends Model
{
    //modelo asociado a tabla CAMPANA
    protected $table = 'CAMPANA';
    protected $primaryKey = 'CAMPANA_ID';
    
    // campaña tiene muchos contactos
    public function contactos()
    {
        return $this->hasMany('App\Contacto','CAMPANA_ID');
    }

    public function oportunidades()
    {
        return $this->hasMany('App\Oportunidad','CAMPANA_ID');
    }

}
