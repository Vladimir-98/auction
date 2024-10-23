<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card\CardStatus;

class CardStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CardStatus::query()->firstOrCreate(['name' => 'Ожидает', 'visibility' => false]);
        CardStatus::query()->firstOrCreate(['name' => 'Публичная', 'visibility' => true]);
        CardStatus::query()->firstOrCreate(['name' => 'Продана', 'visibility' => false]);
        CardStatus::query()->firstOrCreate(['name' => 'Просрочена', 'visibility' => false]);
    }
}
