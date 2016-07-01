<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //modelo asociado a tabla EVENTO
    protected $table = 'EVENTO';
    protected $primaryKey = 'EVENTO_ID';
}
