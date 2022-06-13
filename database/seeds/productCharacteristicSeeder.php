<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class productCharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chars = [
            [
                'name' => 'LCD',
                'description' => 'Pantalla LCD',
                ],
                [
                'name' => 'LED',
                'description' => 'Pantalla LED',
                ],
                [
                'name' => 'OLED',
                'description' => 'Pantalla OLED',
                ],
                [
                'name' => 'AMD',
                'description' => 'Procesador AMD',
                ],
                [
                'name' => 'Intel',
                'description' => 'Procesador Intel Core i9 10ma generacion',
                ],
                [
                'name' => 'Piel',
                'description' => 'Calzado de piel animal',
                ],
                [
                'name' => 'Plastico',
                'description' => 'Calzado de textil sintetico',
                ]
        ];
        
        DB::table('product_characteristic')->insert($chars);
    }
}
