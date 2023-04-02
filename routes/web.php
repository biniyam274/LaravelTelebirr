<?php

use App\Http\Controllers\TelebirrController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::resource('', TelebirrController::class);
Route::post('getjson', [TelebirrController::class, 'getJson']);
Route::post('requestTele', [TelebirrController::class, 'requestTele']);

