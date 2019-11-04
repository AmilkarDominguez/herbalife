<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        
        ////////////////////////////////////////    
        // ROLES//
        $rol_admin = App\Role::create([
            'name' => 'ADMINISTRADOR',
            'description' => 'Rol Administrador.'
        ]);
        App\Role::create([
            'name' => 'ESTANDAR',
            'description' => 'Rol Estandar.'
        ]);

        //CREA EL USUARIOS
        $admin = App\User::create([
            'name' => 'admin',
            'email'=> 'admin@admin.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10)            
        ]);
        //ASIGNACION DE ROLES
        $admin->roles()->attach($rol_admin); 


    }
}
