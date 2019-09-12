<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institutional extends Model
{
    protected $fillable = [
        'estado',
        'mision',
        'vision',
        'direccion',
        'telefono',
        'web',
        'email',
        'contacto',
        'logo',
        'user_id'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
