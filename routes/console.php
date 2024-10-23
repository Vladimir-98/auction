<?php

use App\Facades\Telegram;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Telegram Setup WebHook
Artisan::command('tg:set', function () {

    $response = Telegram::setWebhook()->send();

    $msg = $response['ok']
        ? 'Webhook успешно установлен!'
        : 'Не удалось установить Webhook. Проверьте настройки вашего бота и Webhook URL!';

    $this->info($msg);

})->describe('Установить Webhook для Telegram');


// Telegram Delete WebHook
Artisan::command('tg:del', function () {

    $response = Telegram::deleteWebhook()->send();

    $msg = $response['ok']
        ? 'Webhook успешно удален!'
        : 'Не удалось удалить Webhook. Проверьте настройки вашего бота и Webhook URL!';

    $this->info($msg);

})->describe('Удалить Webhook для Telegram');


// Telegram Test Message
Artisan::command('tg:test', function (){

    $response = Telegram::message(529204894, 'Тестовое сообщение')->send();

    $msg = $response['ok']? 'Отправлено!' : 'Не отправлено!';

    $this->info($msg);

})->describe('Тестовое сообщение');
