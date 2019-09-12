<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'user_id',
        'operacion_id',
        'placa',
        'marca',
        'chasis',
        'modelo',
        'asientos',
        'estado'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function operation()
    {
        return $this->belongsTo(Operation_card::class);
    }
}
