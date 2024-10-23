<?php

namespace App\Actions\Replenishment;

use App\Models\Client\Replenishment;
use Illuminate\Support\Facades\Log;

class CreateAction
{
    public function __invoke(
        int $client_id,
        string $payment_method,
        string $amount,
        array $successful_payment
    ): bool
    {
        try {
            Replenishment::query()->create([
                'client_id' => $client_id,
                'amount' => $amount / 100,
                'payment_method' => $payment_method,
                'metadata' => json_encode($successful_payment)
            ]);
        } catch (\Exception $e) {
            Log::error('Replenishment CreateAction: ' . $e->getMessage());
        }

        return true;
    }
}
