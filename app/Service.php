<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        
        'user_id',
        'razon_social',
        'servicio',
        'direccion',
        'telefono',
        'web',
        'email',
        'contacto',
        'logo',
        'estado'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
