<?php

use App\Http\Controllers\Admin\ShelfController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
    Route::view('/', 'admin.dashboard.index')->name('admin.dashboard');

    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });

    Route::group(['prefix' => 'publishers'], function () {
        Route::get('/', [PublisherController::class, 'index'])->name('admin.publishers.index');
        Route::get('/create', [PublisherController::class, 'create'])->name('admin.publishers.create');
        Route::post('/', [PublisherController::class, 'store'])->name('admin.publishers.store');
        Route::get('/{publisher}/edit', [PublisherController::class, 'edit'])->name('admin.publishers.edit');
        Route::patch('/{publisher}', [PublisherController::class, 'update'])->name('admin.publishers.update');
        Route::delete('/{publisher}', [PublisherController::class, 'destroy'])->name('admin.publishers.destroy');
    });

    Route::group(['prefix' => 'authors'], function () {
        Route::get('/', [AuthorController::class, 'index'])->name('admin.authors.index');
        Route::get('/create', [AuthorController::class, 'create'])->name('admin.authors.create');
        Route::post('/', [AuthorController::class, 'store'])->name('admin.authors.store');
        Route::get('/{author}/edit', [AuthorController::class, 'edit'])->name('admin.authors.edit');
        Route::patch('/{author}', [AuthorController::class, 'update'])->name('admin.authors.update');
        Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('admin.authors.destroy');
    });

    Route::group(['prefix' => 'shelves'], function () {
        Route::get('/', [ShelfController::class, 'index'])->name('admin.shelves.index');
        Route::get('/create', [ShelfController::class, 'create'])->name('admin.shelves.create');
        Route::post('/', [ShelfController::class, 'store'])->name('admin.shelves.store');
        Route::get('/{shelf}/edit', [ShelfController::class, 'edit'])->name('admin.shelves.edit');
        Route::patch('/{shelf}', [ShelfController::class, 'update'])->name('admin.shelves.update');
        Route::delete('/{shelf}', [ShelfController::class, 'destroy'])->name('admin.shelves.destroy');
    });
});
