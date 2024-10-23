<?php

namespace App\Telegram\Webhook;

use Illuminate\Support\Facades\Log;
use App\Telegram\Webhook\Payment\SuccessFulPayment;
use App\Telegram\Webhook\Payment\AnswerPreCheckoutQuery;

class Realization extends Webhook
{
    public function take(): bool|string|null
    {

        try {

            if ($this->getType() == 'bot_command') {
                return self::COMMANDS[$this->getText()] ?? null;
            }

            elseif($this->getPreCheckoutQuery()){
                return AnswerPreCheckoutQuery::class;
            }

            elseif ($this->getSuccessfulPayment()){
                return SuccessFulPayment::class;
            }
        }
        catch (\Exception $e){
            Log::info("Realization " . $e->getMessage());
        }

        return false;
    }
}
