<?php

namespace Database\Seeders;

use App\Models\Card\City;
use Illuminate\Database\Seeder;

class CityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::query()->firstOrCreate(['name' => 'Москва']);
        City::query()->firstOrCreate(['name' => 'Краснодар']);
        City::query()->firstOrCreate(['name' => 'Санкт-Петербург']);
    }
}
