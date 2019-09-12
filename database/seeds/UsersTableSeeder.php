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
        $root = Role::create([
            'name'   => 'Administrador del Sitio',
            'slug'   => 'root',
            'description' =>'Todos los privilegios',
            'special'=> 'all-access'
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
        $admin->assignRoles('root');


    }
}
