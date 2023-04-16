<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['auth', 'verified']
], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('symbols', [App\Http\Controllers\Symbol\ListAction::class, 'index'])->name('symbol.list');
    Route::group([
        'prefix' => 'symbol'
    ], function () {
        Route::get('/toggle', App\Http\Controllers\Symbol\ToggleAction::class)->name('symbol.toggle');
    });

    Route::get('orders', App\Http\Controllers\Order\ListOrdersAction::class)->name('order.list');
    Route::group([
        'prefix' => 'order'
    ], function () {
        Route::post('/', App\Http\Controllers\Order\CreateOrderAction::class)->name('order.create');
        Route::get('/', App\Http\Controllers\Order\CloseOrderAction::class)->name('order.close');
    });

})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
