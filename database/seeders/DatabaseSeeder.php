<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(ClientStatusSeeder::class);
        $this->call(CardStatusSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(FilterSeeder::class);
        $this->call(CityTypeSeeder::class);
    }
}
