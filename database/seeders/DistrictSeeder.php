<?php

namespace Database\Seeders;

use App\Models\Card\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        District::query()->firstOrCreate(['name' => 'Музыкальный']);
        District::query()->firstOrCreate(['name' => 'Российский']);
        District::query()->firstOrCreate(['name' => 'Юбилейный']);
        District::query()->firstOrCreate(['name' => 'ЗИЛ']);
        District::query()->firstOrCreate(['name' => 'Центральный']);
        District::query()->firstOrCreate(['name' => 'Гидростроителей']);
        District::query()->firstOrCreate(['name' => 'Фестивальный']);
        District::query()->firstOrCreate(['name' => 'Черемушки']);
        District::query()->firstOrCreate(['name' => 'Энка']);
    }
}
