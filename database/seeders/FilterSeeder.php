<?php

namespace Database\Seeders;

use App\Models\Filter;
use App\Models\Card\Type;
use App\Models\Card\Budget;
use App\Models\Card\District;
use App\Models\Card\PriceLead;
use Illuminate\Database\Seeder;
use App\Models\Card\PaymentType;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Filter::query()->firstOrCreate([
            'name' => Filter::CATEGORIES,
            'title' => __('fields.filter.' . Filter::CATEGORIES),
            'type' => Filter::CHECKBOX,
            'items' => Type::class
        ]);

        Filter::query()->firstOrCreate([
            'name' => Filter::DISTRICTS,
            'title' => __('fields.filter.' . Filter::DISTRICTS),
            'type' => Filter::CHECKBOX,
            'items' => District::class
        ]);

        Filter::query()->firstOrCreate([
            'name' => Filter::PAYMENT_TYPE,
            'title' => __('fields.filter.' . Filter::PAYMENT_TYPE),
            'type' => Filter::CHECKBOX,
            'items' => PaymentType::class
        ]);

        Filter::query()->firstOrCreate([
            'name' => Filter::BUDGET,
            'title' => __('fields.filter.' . Filter::BUDGET),
            'type' => Filter::RANGE_INPUT,
            'items' => Budget::class
        ]);

        Filter::query()->firstOrCreate([
            'name' => Filter::LEAD_PRICE,
            'title' => __('fields.filter.' . Filter::LEAD_PRICE),
            'type' => Filter::RANGE_INPUT,
            'items' => PriceLead::class
        ]);
    }
}
