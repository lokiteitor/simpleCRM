<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    //modelo asociado a tabla TAREA
    protected $table = 'TAREA';
    protected $primaryKey = 'TAREA_ID';
}
