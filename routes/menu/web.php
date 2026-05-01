<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('menu-items', MenuItemController::class);