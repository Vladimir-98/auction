<?php


namespace App\Telegram\Webhook\Payment;

use App\Facades\Telegram;
use App\Models\Client\Client;
use App\Telegram\Webhook\Webhook;
use App\Actions\Replenishment\CreateAction as ReplenishmentCreateAction;

class SuccessFulPayment extends Webhook
{
    public function run()
    {
        $successfulPayment = $this->getSuccessfulPayment();
        $amount = $successfulPayment['total_amount'] ?? null;
        $payment_method = $successfulPayment['invoice_payload'] ?? '';
        $currency = $successfulPayment['currency'] ?? '';
        $client = Client::query()->firstWhere('telegram_id', $this->getChatId());

        (new ReplenishmentCreateAction())(
            $client->id,
            $payment_method,
            $amount,
            $this->getSuccessfulPayment()
        );

        $amount =  number_format($amount / 100, 2, ',', ' ');

        return Telegram::message(
            $this->getChatId(),
            "Спасибо за оплату! Мы получили {$amount} {$currency}."
        )->send();
    }
}
