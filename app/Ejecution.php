<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejecution extends Model
{
    protected $fillable = [
        'plan_id',
        'client_id',
        'fecha',
        'verificado',
        'estado'
    ];
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class);
    }
}
