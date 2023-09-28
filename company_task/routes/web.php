<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;


// Route::get('/', [ItemController::class, 'index'])->name('item.index');
Route::post('/store', [ItemController::class, 'store'])->name('item.store');
Route::get('/', [ItemController::class, 'index'])->name('users.index');