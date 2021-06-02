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


        /*Diets*/
        App\Diet::create([
            'codigo' => '1v',
            'nombre' => '1v',
            'desayuno' => 'Vaso de leche y tres tortitas pequeñas de plátano.',
            'merienda_am' => 'Batido de yogur natural y melocotón (1 unidad).',
            'almuerzo' => 'Ensalada templada de verduras asadas con aliño de naranja al hinojo.',
            'merienda_pm' => 'Té o café con medio bocadillo de queso, tomate (1/2 unidad) y hojas de lechuga fresca.',
            'cena' => 'Dos porciones de Tortilla de verduras.'
        ]);

        App\Diet::create([
            'codigo' => '2v',
            'nombre' => '2v',
            'desayuno' => 'Tazón de leche con cerezas frescas (10 unidades), avena y almendras picadas.',
            'merienda_am' => 'Dos unidades de brochetas de frutas frescas.',
            'almuerzo' => 'Una porción de pasta integral con verduras.',
            'merienda_pm' => '	Yogur con pipas de girasol y albaricoque en trozos (1 unidad).',
            'cena' => 'Tartar templado de verduras con aguacate y huevo.'
        ]);

        App\Diet::create([
            'codigo' => '3v',
            'nombre' => '3v',
            'desayuno' => 'Batido de leche y plátano (1/2 unidad) con cereales y semillas de sésamo.',
            'merienda_am' => 'Té o café con dos tostadas con puré de aguacate (1/2 unidad pequeña) y tomate (1/2 unidad).',
            'almuerzo' => 'Ternera a la plancha con una porción de ensalada de arroz y judías verdes.',
            'merienda_pm' => 'Yogur con avena y kiwi en trozos (1/2 unidad).',
            'cena' => 'Zoodles de calabacín marinados con higos frescos y queso.'
        ]);
        App\Diet::create([
            'codigo' => '4v',
            'nombre' => '4v',
            'desayuno' => 'Vaso de leche y tres tortitas pequeñas de plátano.',
            'merienda_am' => 'Batido de yogur natural y melocotón (1 unidad).',
            'almuerzo' => 'Ensalada templada de verduras asadas con aliño de naranja al hinojo.',
            'merienda_pm' => 'Té o café con medio bocadillo de queso, tomate (1/2 unidad) y hojas de lechuga fresca.',
            'cena' => 'Dos porciones de Tortilla de verduras.'
        ]);

        App\Diet::create([
            'codigo' => '5v',
            'nombre' => '5v',
            'desayuno' => 'Tazón de leche con cerezas frescas (10 unidades), avena y almendras picadas.',
            'merienda_am' => 'Dos unidades de brochetas de frutas frescas.',
            'almuerzo' => 'Una porción de pasta integral con verduras.',
            'merienda_pm' => '	Yogur con pipas de girasol y albaricoque en trozos (1 unidad).',
            'cena' => 'Tartar templado de verduras con aguacate y huevo.'
        ]);


        App\Diet::create([
            'codigo' => '1m',
            'nombre' => '1m',
            'desayuno' => 'Vaso de leche y tres tortitas pequeñas de plátano.',
            'merienda_am' => 'Batido de yogur natural y melocotón (1 unidad).',
            'almuerzo' => 'Ensalada templada de verduras asadas con aliño de naranja al hinojo.',
            'merienda_pm' => 'Té o café con medio bocadillo de queso, tomate (1/2 unidad) y hojas de lechuga fresca.',
            'cena' => 'Dos porciones de Tortilla de verduras.'
        ]);

        App\Diet::create([
            'codigo' => '2m',
            'nombre' => '2m',
            'desayuno' => 'Tazón de leche con cerezas frescas (10 unidades), avena y almendras picadas.',
            'merienda_am' => 'Dos unidades de brochetas de frutas frescas.',
            'almuerzo' => 'Una porción de pasta integral con verduras.',
            'merienda_pm' => '	Yogur con pipas de girasol y albaricoque en trozos (1 unidad).',
            'cena' => 'Tartar templado de verduras con aguacate y huevo.'
        ]);

        App\Diet::create([
            'codigo' => '3m',
            'nombre' => '3m',
            'desayuno' => 'Batido de leche y plátano (1/2 unidad) con cereales y semillas de sésamo.',
            'merienda_am' => 'Té o café con dos tostadas con puré de aguacate (1/2 unidad pequeña) y tomate (1/2 unidad).',
            'almuerzo' => 'Ternera a la plancha con una porción de ensalada de arroz y judías verdes.',
            'merienda_pm' => 'Yogur con avena y kiwi en trozos (1/2 unidad).',
            'cena' => 'Zoodles de calabacín marinados con higos frescos y queso.'
        ]);
        App\Diet::create([
            'codigo' => '4m',
            'nombre' => '4m',
            'desayuno' => 'Vaso de leche y tres tortitas pequeñas de plátano.',
            'merienda_am' => 'Batido de yogur natural y melocotón (1 unidad).',
            'almuerzo' => 'Ensalada templada de verduras asadas con aliño de naranja al hinojo.',
            'merienda_pm' => 'Té o café con medio bocadillo de queso, tomate (1/2 unidad) y hojas de lechuga fresca.',
            'cena' => 'Dos porciones de Tortilla de verduras.'
        ]);

        App\Diet::create([
            'codigo' => '5m',
            'nombre' => '5m',
            'desayuno' => 'Tazón de leche con cerezas frescas (10 unidades), avena y almendras picadas.',
            'merienda_am' => 'Dos unidades de brochetas de frutas frescas.',
            'almuerzo' => 'Una porción de pasta integral con verduras.',
            'merienda_pm' => '	Yogur con pipas de girasol y albaricoque en trozos (1 unidad).',
            'cena' => 'Tartar templado de verduras con aguacate y huevo.'
        ]);

    }
}
