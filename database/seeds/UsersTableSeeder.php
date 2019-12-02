<?php

use Illuminate\Database\Seeder;

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
            'description' => 'Rol administrador.'
        ]);
        $rol_asesor = App\Role::create([
            'name' => 'ASESOR',
            'description' => 'Rol asesor encargado de registrar clientes.'
        ]);
        $rol_cliente = App\Role::create([
            'name' => 'CLIENTE',
            'description' => 'Rol cliente.'
        ]);

        //CREA EL USUARIOS
        $admin = App\User::create([
            'name' => 'admin',
            'email'=> 'admin@admin.com',
            'state' => 'ACTIVO',
            'state_rol' => 'ADMINISTRADOR',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10)            
        ]);
        //ASIGNACION DE ROLES
        $admin->roles()->attach($rol_admin); 

        //CREA EL ASESOR
        $asesor = App\User::create([
            'name' => 'asesor',
            'email'=> 'asesor@asesor.com',
            'state' => 'ACTIVO',
            'state_rol' => 'ASESOR',
            'email_verified_at' => now(),
            'password' => bcrypt('asesor'),
            'remember_token' => str_random(10)            
        ]);
        //ASIGNACION DE ROLES
        $asesor->roles()->attach($rol_asesor); 

        //CREA EL CLIENTE
        $cliente1 = App\User::create([
            'name' => 'cliente1',
            'email'=> 'cliente1@cliente1.com',
            'state' => 'ACTIVO',
            'state_rol' => 'CLIENTE',
            'email_verified_at' => now(),
            'password' => bcrypt('cliente1'),
            'fecha_nacimiento' => '1990-12-12',
            'sexo' => 'HOMBRE',
            'estatura' => '120',
            'peso' => '80',
            'direccion' => 'Tarija',
            'remember_token' => str_random(10)            
        ]);
        $cliente1->codigo= str_random(4).$cliente1->id;
        $cliente1->update();
        //ASIGNACION DE ROLES
        $cliente1->roles()->attach($rol_cliente); 
    
    }
}
