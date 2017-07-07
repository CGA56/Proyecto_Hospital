<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    protected $fillable = [
       'fecha_hora',
       'id_paciente',
       'id_medico',
       'estado',

    ];
}
