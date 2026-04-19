<?php

use Illuminate\Support\Facades\Route;
use Src\Logistics\Order\Controllers\OrderController;

Route::prefix('api/v1/logistics')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('orders', [OrderController::class, 'store']);
    });
