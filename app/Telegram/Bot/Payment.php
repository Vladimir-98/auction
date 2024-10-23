<?php

namespace App\Telegram\Bot;

class Payment extends Bot
{

    public function createInvoiceLink(
        string $title = '',
        string $description = '',
        string $payload = '',
        string $currency = '',
        array $prices = [],
    ): self
    {

        $this->method = 'createInvoiceLink';
        $providerToken = config('services.telegram.provider_token');

        $this->data = [
            'title' => $title,
            'description' => $description,
            'payload' => $payload,
            'provider_token' => $providerToken,
            'currency' => $currency,
            'prices' => json_encode($prices),
        ];

        return $this;
    }

    public function answerPreCheckoutQuery(
            string $pre_checkout_query_id,
        bool $state = true,
        ?string $errorMessage = null
    ): self
    {
        $this->method = 'answerPreCheckoutQuery';

        $this->data = [
            'pre_checkout_query_id' => $pre_checkout_query_id,
            'ok' => $state
        ];

        if ($errorMessage) {
            $this->data['errorMessage'] = $errorMessage;
        }

        return $this;
    }
}
