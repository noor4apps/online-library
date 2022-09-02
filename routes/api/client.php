<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\Client\IndexController;
use App\Http\Controllers\Api\Client\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'client'], function () {

    Route::get('/', [IndexController::class, 'index']);
    Route::get('/grid', [IndexController::class, 'grid']);
    Route::get('/single/{book}', [IndexController::class, 'show']);

    Route::group(['prefix' => 'orders', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('site.orders.index');
        Route::post('/{book}', [OrderController::class, 'store'])->name('site.orders.store');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('site.orders.destroy');
    });

});
