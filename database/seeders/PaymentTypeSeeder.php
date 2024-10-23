<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentType::query()->firstOrCreate(['name' => 'Ипотека']);
        PaymentType::query()->firstOrCreate(['name' => 'Наличные']);
    }
}
