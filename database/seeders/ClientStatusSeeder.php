<?php

namespace Database\Seeders;

use App\Models\Client\Status;
use Illuminate\Database\Seeder;

class ClientStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::query()->firstOrCreate(['name' => 'Активный']);
        Status::query()->firstOrCreate(['name' => 'Не Активный']);
        Status::query()->firstOrCreate(['name' => 'Архивный']);
    }
}
