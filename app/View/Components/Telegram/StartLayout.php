<?php

namespace App\View\Components\Telegram;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class StartLayout extends Component
{
    public function __construct()
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.telegram.start-layout');
    }
}
