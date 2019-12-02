<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = [
        'routine_id',
        'product_id',
        'user_id',
        'dosis',
        'estado'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
