<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class InstitutionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        
        //CREA EL USUARIOS
        App\Institutional::create([
            'estado'=> 'ACTIVO',
            'mision'=> '---',
            'vision'=> '---',
            'direccion'=> '---',
            'telefono'=> '---',
            'web'=> '---',
            'email'=> '---',
            'contacto'=> '---',
            'user_id' => '1'          
        ]);


    }
}
