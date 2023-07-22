<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
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

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'createRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
    Route::get('/login', [AuthController::class, 'createLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('home');
    Route::get('/tictactoe/{room}', [RoomController::class, 'tictactoe'])->name('tictactoe');
    Route::get('/partner', [RoomController::class, 'partner'])->name('partner');
    Route::get('/checkout', [RoomController::class, 'checkout'])->name('checkout');
});

Route::get('/admin')->middleware('admin');
