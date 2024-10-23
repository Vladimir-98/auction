<?php

namespace App\Facades;

use App\Telegram\Bot\Bot;
use App\Telegram\Bot\File;
use Illuminate\Http\Request;
use App\Telegram\Bot\Message;
use App\Telegram\Bot\Payment;
use App\Telegram\Bot\Connection;
use Illuminate\Support\Facades\Facade;
use App\Telegram\Verification\InitData;

/**
 * @method static Connection setWebhook()
 * @method static Connection deleteWebhook()
 * @method static Message message(string $chat_id, string $text, $reply_id = null)
 * @method static File audio(string $chat_id, string $audio, $caption = '')
 * @method static Message buttons(string $chat_id, string $text, array $buttons, $reply_id = null)
 * @method static Payment createInvoiceLink(string $title = '', string $description = '', string $payload = '', string $currency = '', array $prices = [])
 * @method static InitData checkInitData(Request $request)
 *
 * @method Bot send()
 */
class Telegram extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Telegram::class;
    }
}
