<?php


namespace App\Telegram\Webhook\Payment;

use App\Facades\Telegram;
use App\Telegram\Webhook\Webhook;

class AnswerPreCheckoutQuery extends Webhook
{
    public function run()
    {
        $pre_checkout_query = $this->getPreCheckoutQuery()['id'] ?? false;
        return Telegram::answerPreCheckoutQuery($pre_checkout_query, (bool)$pre_checkout_query)->send();
    }
}
