<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    //
    protected $fillable = [
        'codigo',
        'nombre',
        'desayuno',
        'merienda_am',
        'almuerzo',
        'merienda_pm',
        'cena',
        'estado'
        
    ];
}
