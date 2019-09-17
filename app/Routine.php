<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable =[
        'user_id',
        'nombre_rutina',
        'fecha',
        'foto',
        'estado'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
