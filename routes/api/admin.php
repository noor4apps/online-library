<?php

use App\Http\Controllers\Api\Admin\BookController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\PublisherController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'is_admin']], function () {

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });

    Route::group(['prefix' => 'publishers'], function () {
        Route::get('/', [PublisherController::class, 'index'])->name('admin.publishers.index');
        Route::post('/', [PublisherController::class, 'store'])->name('admin.publishers.store');
        Route::get('/{publisher}/edit', [PublisherController::class, 'edit'])->name('admin.publishers.edit');
        Route::patch('/{publisher}', [PublisherController::class, 'update'])->name('admin.publishers.update');
        Route::delete('/{publisher}', [PublisherController::class, 'destroy'])->name('admin.publishers.destroy');
    });

    Route::group(['prefix' => 'books'], function () {
        Route::get('/', [BookController::class, 'index'])->name('admin.books.index');
        Route::get('/create', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('/', [BookController::class, 'store'])->name('admin.books.store');
        Route::get('/{book}', [BookController::class, 'show'])->name('admin.books.show');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
        Route::patch('/{book}', [BookController::class, 'update'])->name('admin.books.update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');
    });

});
