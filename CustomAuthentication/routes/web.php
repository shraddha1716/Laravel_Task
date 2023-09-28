<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\Auth\CustomLoginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('custom.register.form');
Route::post('/register', [CustomRegisterController::class, 'register'])->name('custom.register');

Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('custom.login.form');
Route::post('/login', [CustomLoginController::class, 'login'])->name('custom.login');

Route::get('/home', [CustomLoginController::class, 'dashboard'])->name('dashboard');

Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');

