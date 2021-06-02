<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDiet extends Model
{
    protected $fillable = [
        'client_id',
        'diet_id'
    ];
    public function client()
    {
        return $this->belongsTo(User::class);
    }
    public function diet()
    {
        return $this->belongsTo(Diet::class);
    }
}
