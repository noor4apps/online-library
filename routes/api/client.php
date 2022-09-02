<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\Client\IndexController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'client'], function () {

    Route::get('/', [IndexController::class, 'index']);
    Route::get('/grid', [IndexController::class, 'grid']);
    Route::get('/single/{book}', [IndexController::class, 'show']);

});
