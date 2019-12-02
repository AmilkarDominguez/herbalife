<?php

use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Tipos
        App\Type::create([
            'nombre' => 'Suplemento',
            'estado' => 'ACTIVO',
            'user_id' => '1'
        ]);
        App\Type::create([
            'nombre' => 'Batido',
            'estado' => 'ACTIVO',
            'user_id' => '1'
        ]);
        App\Type::create([
            'nombre' => 'Concentrado',
            'estado' => 'ACTIVO',
            'user_id' => '1'
        ]);
        // //Productos
        App\Product::create([
            'user_id' => '1',
            'type_id' => '1',
            'nombre' => 'Aloe Mandarina',
            'presentacion' => 'Tarro',
            'precio' => '20',
            'foto' => '/images/Productos/Aloe_Mandarina-BL-250x250-3.jpg',
            'estado' => 'ACTIVO'
        ]);
        App\Product::create([
            'user_id' => '1',
            'type_id' => '2',
            'nombre' => 'Complemento multivitamínico',
            'presentacion' => 'Tarro',
            'precio' => '30',
            'foto' => '/images/Productos/HerbalifelineInternas.jpg',
            'estado' => 'ACTIVO'
        ]);
        App\Product::create([
            'user_id' => '1',
            'type_id' => '3',
            'nombre' => 'Proteína',
            'presentacion' => 'Tarro',
            'precio' => '50',
            'foto' => '/images/Productos/ProteinaenPolvoInternas.jpg',
            'estado' => 'ACTIVO'
        ]);
    }
}
