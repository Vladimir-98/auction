<?php

namespace App\Telegram\Bot;

class Connection extends Bot
{
    private string $webhookUrl;

    public function __construct()
    {
        $tg_route = config('services.telegram.webhook_url');
        $this->webhookUrl = $tg_route
            ? $tg_route . '/api/v1/telegram/webhook'
            : route('telegram.webhook');
    }

    public function setWebhook(): self
    {
        $this->method = 'setWebhook';
        $this->data = [
            'url' => $this->webhookUrl,
        ];

        return $this;
    }

    public function deleteWebhook(): self
    {
        $this->method = 'deleteWebhook';
        $this->data = [
            'url' => $this->webhookUrl,
        ];

        return $this;
    }
}
