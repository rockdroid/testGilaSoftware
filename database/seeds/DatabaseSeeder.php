<?php

use App\productType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(productTypeSeeder::class);
        $this->call(productCharacteristicSeeder::class);
    }
}
