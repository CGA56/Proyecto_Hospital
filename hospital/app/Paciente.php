<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'id', 'rut', 'nombre', 'fecha_nacimiento', 'sexo', 'direccion', 'telefono'
    ];
}
