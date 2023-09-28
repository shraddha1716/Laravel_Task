<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

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


Route::get('/file',[FileUploadController::class,'index'])->name('file.upload.form');
Route::post('/file-upload',[FileUploadController::class,'upload'])->name('file.upload');
Route::get('/edit-image/{id}',[FileUploadController::class,'editImage'])->name('edit.image');
Route::put('/update-image/{id}',[FileUploadController::class,'updateImage'])->name('update.image');
Route::delete('/delete-image/{id}',[FileUploadController::class,'deleteImage'])->name('delete.image');







