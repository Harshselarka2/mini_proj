<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;  // <-- Add this

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WeatherController::class, 'index']);
Route::post('/search', [WeatherController::class, 'search']);
Route::view('/about', 'about');

