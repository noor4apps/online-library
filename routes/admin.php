<?php

use Illuminate\Support\Facades\Route;

Route::view('/admin', 'admin.dashboard.index');
Route::view('/admin/login', 'admin.auth.login');
