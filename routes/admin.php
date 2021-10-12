<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'  =>  'admin', 'middleware' => 'is_admin'], function () {
    Route::view('/', 'admin.dashboard.index')->name('admin.dashboard');

    Route::get('/settings',     [SettingController::class,'index'])->name('admin.settings');
    Route::post('/settings',    [SettingController::class, 'update'])->name('admin.settings.update');
});
