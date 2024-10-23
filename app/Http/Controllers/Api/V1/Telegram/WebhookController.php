<?php

namespace App\Http\Controllers\Api\V1\Telegram;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Telegram\Webhook\Realization;

class WebhookController extends Controller
{

    public function __invoke(Request $request, Realization $realization): string
    {

//        file_put_contents('telegram.txt', json_encode(request()->all()), FILE_APPEND);

        if (!$path = $realization->take()) return false;

        try {
            App::make($path)->run();
        } catch (\Exception $e) {
            Log::error('Webhook run error: ' . $e->getMessage());
        }

        return 'ok';
    }
}
