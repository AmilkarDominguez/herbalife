<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;




class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','state',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
    public function auspices()
    {
        return $this->hasMany(Auspice::class);
    }
    public function institutionals()
    {
        return $this->hasMany(Institutional::class);
    }
    public function presenters()
    {
        return $this->hasMany(Presenter::class);
    }
    public function program()
    {
        return $this->hasMany(Program::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    //funciones para el manejo de roles y permisos 
    public function authorizeRol($roles) {
        abort_unless($this->hasAnyRole($roles), 401,'No tiene Autorización para Acceder a este contenido.');
        return true;
        
    }
    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                 return true; 
            }   
        }
        return false;
    }
    public function hasRole($role) {
        if($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
