<?php

namespace App\Telegram\Webhook\Commands;

use App\Facades\Telegram;
use App\Telegram\Webhook\Webhook;

class Auction extends Webhook
{
    public function run()
    {
        $tg_route = config('services.telegram.webhook_url');

        $auctionUrl = $tg_route ? $tg_route . '/telegram/auction' : route('telegram.auction');

        $buttons = [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Вперед',
                        'web_app' => ['url' => $auctionUrl]
                    ]
                ]
            ]
        ];
        return Telegram::buttons($this->getChatId(), 'Открыть каталог в приложении', $buttons)->send();
    }
}
