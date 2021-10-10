<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'  =>  'admin', 'middleware' => 'is_admin'], function () {
    Route::view('/', 'admin.dashboard.index')->name('admin.dashboard');
});
