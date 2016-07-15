<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tareas()
    {
        return $this->hasMany('App\Tarea','id','USUARIO_ID');
    }
    public function oportunidades()
    {
        return $this->hasMany('App\Oportunidad','USUARIO_ID','id');
    }    
    public function eventos()
    {
        return $this->hasMany('App\Evento','id','USUARIO_ID');
    }

}
