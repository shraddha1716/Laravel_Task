<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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


 
// ---------------- for group route middleware or global middleware-----------------------

Route::group(['middleware' => ['authcustom']],function(){
    Route::get('/test', [TestController::class, 'testing']);
    Route::get('/check', [TestController::class, 'checking']);
});
Route::get('/check1', [TestController::class, 'checking']);

// ---------------- for single middleware -----------------------------------------------------

// Route::get('/check', [TestController::class, 'checking'])->middleware('authcustom');

