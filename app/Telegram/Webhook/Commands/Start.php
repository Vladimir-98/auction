<?php

namespace App\Telegram\Webhook\Commands;

use App\Facades\Telegram;
use Illuminate\Http\Request;
use App\Telegram\Webhook\Webhook;
use App\View\Components\Telegram\StartLayout;

class Start extends Webhook
{
    public function __construct(Request $request, private StartLayout $startLayout)
    {
        parent::__construct($request);
    }

    public function run()
    {
        return Telegram::message($this->getChatId(), $this->startLayout->render())->send();
    }
}
