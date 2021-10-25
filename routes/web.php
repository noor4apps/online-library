<?php

use App\Http\Controllers\Site\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', [IndexController::class, 'index'])->name('site.index');
Route::get('/grid', [IndexController::class, 'grid'])->name('site.grid');
Route::get('/{book}', [IndexController::class, 'show'])->name('site.show');


Route::view('/orders', 'site.orders.index')->name('site.orders')->middleware('auth');

