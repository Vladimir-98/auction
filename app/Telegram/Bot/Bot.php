<?php

namespace App\Telegram\Bot;

use Illuminate\Support\Facades\Http;

class Bot
{
    protected array $data;
    protected string $file;
    protected string $method;
    protected string $fileType;

    public function send()
    {
        $baseUrl = 'https://api.telegram.org/bot' . config('services.telegram.token');
        return Http::post(
            $baseUrl . '/' . $this->method,
            $this->data
        )->json();
    }
}
