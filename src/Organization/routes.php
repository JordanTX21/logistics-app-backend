<?php

use Illuminate\Support\Facades\Route;
use Src\Organization\Controllers\AgencyController;

Route::prefix('api/v1/organization')
    ->middleware('auth:api') // all organization routes require authentication
    ->group(function () {
        Route::apiResource('agencies', AgencyController::class);
    });
