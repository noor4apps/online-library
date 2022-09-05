<?php

use App\Http\Controllers\Api\Admin\AuthorController;
use App\Http\Controllers\Api\Admin\BookController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\MemberController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\PublisherController;
use App\Http\Controllers\Api\Admin\ShelfController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'is_admin']], function () {

    Route::get('/', [DashboardController::class, 'index']);

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

    Route::group(['prefix' => 'authors'], function () {
        Route::get('/', [AuthorController::class, 'index'])->name('admin.authors.index');
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

    Route::group(['prefix' => 'books'], function () {
        Route::get('/', [BookController::class, 'index'])->name('admin.books.index');
        Route::get('/create', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('/', [BookController::class, 'store'])->name('admin.books.store');
        Route::get('/{book}', [BookController::class, 'show'])->name('admin.books.show');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
        Route::patch('/{book}', [BookController::class, 'update'])->name('admin.books.update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');
    });

    Route::group(['prefix' => 'members'], function () {
        Route::get('/', [MemberController::class, 'index'])->name('admin.members.index');
        Route::post('/', [MemberController::class, 'store'])->name('admin.members.store');
        Route::get('/{member}', [MemberController::class, 'show'])->name('admin.books.show');
        Route::get('/{member}/edit', [MemberController::class, 'edit'])->name('admin.members.edit');
        Route::patch('/{member}', [MemberController::class, 'update'])->name('admin.members.update');
        Route::delete('/{member}', [MemberController::class, 'destroy'])->name('admin.members.destroy');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
        Route::patch('/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
    });

});
