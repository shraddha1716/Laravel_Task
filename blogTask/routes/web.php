<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;


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
Route::get('/register', [UserController::class, 'index'])->name('register.index');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'loginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');

Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::post('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');

Route::get('blogs/pdf', [BlogController::class, 'showPdf'])->name('blogs.pdf');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');




