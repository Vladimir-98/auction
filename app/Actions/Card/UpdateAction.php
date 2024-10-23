<?php


namespace App\Actions\Card;


use App\Models\Card\Card;

class UpdateAction
{
    public function __invoke(array $data): Card
    {
        return Card::updateOrCreate([
            'name' => $data['name'],
            'desc' => $data['desc'] ?? null,
            'phone' => $data['phone'] ?? null,
            'budget_min' => $data['budget_min'] ?? null,
            'budget_max' => $data['budget_max'] ?? null,
            'lead_price' => $data['lead_price'],
            'status_id' => $data['status_id'],
            'crm_id' => $data['crm_id'],
            'crm_url' => $data['crm_url'],
        ]);
    }
}
