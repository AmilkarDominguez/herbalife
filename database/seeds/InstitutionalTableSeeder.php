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
            'mision'=> 'DESARROLLAR UNA PRODUCCIÓN, PROGRAMACIÓN Y DIFUSIÓN TELEVISIVA DE ALTA CALIDAD, REFLEJANDO LA IDENTIDAD Y LOS INTERESES DE LA SOCIEDAD TARIJEÑA.',
            'vision'=> 'SOMOS UNA RED DE TELEVISIÓN QUE UNE MEDIANTE LA EMISIÓN TELEVISIVA AL DEPARTAMENTO DE TARIJA Y A SU VEZ LLEVA LA IMAGEN DEPARTAMENTAL AL CONJUNTO DEL PAÍS.',
            'direccion'=> 'Tarija Bolivia',
            'telefono'=> '66-68865',
            'web'=> 'plustlt.tv',
            'email'=> 'plustlt.tarija@gmail.com',
            'contacto'=> 'Contacto',
            'user_id' => '1'          
        ]);


    }
}
