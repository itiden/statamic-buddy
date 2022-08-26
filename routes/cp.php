<?php

use Illuminate\Support\Facades\Route;
use Itiden\StatamicBuddy\Http\Controllers\Api\DeployApiController;
use Itiden\StatamicBuddy\Http\Controllers\Api\LogApiController;
use Itiden\StatamicBuddy\Http\Controllers\DeployLogController;

Route::name('buddy.')->prefix('buddy')->group(function () {
    Route::get('/', DeployLogController::class)->name('log');

    Route::name('api.')->prefix('api')->group(function () {
        Route::get('log', LogApiController::class)->name('log');
        Route::post('deploy', DeployApiController::class)->name('deploy');
    });
});
