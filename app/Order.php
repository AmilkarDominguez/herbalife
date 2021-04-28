<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [

        'user_id',
        'nombre',
        'foto',
        'presentacion',
        'precio',
        'cantidad',
        'tipo',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
