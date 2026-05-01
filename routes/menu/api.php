<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuItemApiController;

Route::apiResource('menu-items', MenuItemApiController::class);