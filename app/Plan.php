<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'routine_id',
        'user_id',
        'client_id',
        'fecha_inicio',
        'fecha_fin',
        'hora_alarma',
        'mensaje',
        'verificado',
        'estado'
    ];
    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class);
    }
}
