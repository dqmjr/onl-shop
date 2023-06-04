<?php

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


Route::get('/', [\App\Http\Controllers\MainController::class, 'index']);
Route::get('/categories', [\App\Http\Controllers\MainController::class, 'categories']);
Route::get('/mobiles/iphone_x_64', [\App\Http\Controllers\MainController::class, 'product']);

