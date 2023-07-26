<?php

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


require __DIR__.'/auth.php';

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('index');
Route::get('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/basket', [\App\Http\Controllers\BasketController::class, 'basket'])->name('basket');
    Route::get('/basket/place', [\App\Http\Controllers\BasketController::class, 'basketPlace'])->name('basket-place');
    Route::post('/basket/add/{id}', [\App\Http\Controllers\BasketController::class, 'basketAdd'])->name('basket-add');
    Route::post('/basket/remove/{id}',[\App\Http\Controllers\BasketController::class, 'basketRemove'])->name('basket-remove');
    Route::post('/basket/place', [\App\Http\Controllers\BasketController::class, 'basketConfirm'])->name('basket-confirm');
});

Route::get('/categories', [\App\Http\Controllers\MainController::class, 'categories'])->name('categories');

Route::get('/{category}/{product?}', [\App\Http\Controllers\MainController::class, 'product'])->name('product');
Route::get('/{category}', [\App\Http\Controllers\MainController::class, 'category'])->name('category');


