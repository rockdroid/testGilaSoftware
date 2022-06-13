<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class productTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
            'name' => 'TV',
            'description' => 'Pantalla de television',
            ],
            [
            'name' => 'LAPTOP',
            'description' => 'Computadora portatil pantalla LED',
            ],
            [
            'name' => 'ZAPATOS',
            'description' => 'Calzado para toda la familia',
            ]
        ];
        
        DB::table('product_type')->insert($types);
    }
}
