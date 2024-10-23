<?php

namespace Database\Seeders;

use App\Models\Card\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::query()->firstOrCreate([
            'name' => 'Новостройка',
            'icon' => '/upload/svg/novostroyki.svg',
            'visibility' => true
        ]);
        Type::query()->firstOrCreate([
            'name' => 'Вторичка',
            'icon' => '/upload/svg/vtorychka.svg',
            'visibility' => true
        ]);
        Type::query()->firstOrCreate([
            'name' => 'ИЖС',
            'icon' => '/upload/svg/IZHS.svg',
            'visibility' => true
        ]);
        Type::query()->firstOrCreate([
            'name' => 'Коммерция',
            'icon' => '/upload/svg/komercheskaya.svg',
            'visibility' => true
        ]);
    }
}
