<?php

namespace App\Telegram\Verification;

use Illuminate\Http\Request;

class InitData
{

    public function checkInitData($request): bool
    {
        $queryString = $request->header('X-Init-Data');
        $botToken = config('services.telegram.token');

        parse_str($queryString, $data);

        if (!isset($data['hash']) || !isset($data['user'])) {
            return false;
        }

        $hash = $data['hash'];
        unset($data['hash']);
        ksort($data);

        $dataCheckString = implode("\n", array_map(fn($key) => "$key={$data[$key]}", array_keys($data)));
        $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);
        $generatedHash = bin2hex(hash_hmac('sha256', $dataCheckString, $secretKey, true));

        if (hash_equals($hash, $generatedHash)) {
            $client = json_decode($data['user'], true);
            $client['telegram_id'] = $client['id'];
            unset($client['id']);
            request()->merge(['client' => $client]);

            return true;
        }

        return false;
    }
}
