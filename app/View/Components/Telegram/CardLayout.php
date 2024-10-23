<?php

namespace App\View\Components\Telegram;

use Closure;
use App\Models\Card\Card;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CardLayout extends Component
{
    public function __construct(public Card $card)
    {

    }

    public function render(): View|Closure|string
    {
        return view('components.telegram.card-layout', ['card' => $this->card]);
    }
}
