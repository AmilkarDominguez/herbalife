<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation_card extends Model
{
    protected $fillable =[
        'user_id',
        'nit',
        'empresa',
        'descripcion',
        'fecha_registro',
        'fecha_vigencia',
        'responsable',
        'telefono',
        'email',
        'estado'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
