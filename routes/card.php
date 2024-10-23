<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Card\UpdateController;


Route::prefix('/v1/card')->group(function () {

    Route::post('/', UpdateController::class)
        ->middleware('check.crm.token');
});



