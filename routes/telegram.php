<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Telegram\InitController;
use App\Http\Controllers\Api\V1\Telegram\PaymentController;
use App\Http\Controllers\Api\V1\Telegram\WebhookController;
use App\Http\Controllers\Api\V1\Telegram\BuyOrdersController;
use App\Http\Controllers\Api\V1\Telegram\IndexOrderController;

Route::prefix('/v1/telegram/')->group(function () {

    Route::middleware('verified.telegram')->group(function () {

        Route::post('validation', InitController::class)
            ->name('telegram.validation');

        Route::post('create-link-invoice', PaymentController::class)
            ->name('telegram.create_link_invoice');

        Route::post('orders', IndexOrderController::class)
            ->name('telegram.orders');

        Route::post('buy-orders', BuyOrdersController::class)
            ->name('telegram.buy_orders');
    });

    Route::post('webhook', WebhookController::class)
        ->name('telegram.webhook');
});



