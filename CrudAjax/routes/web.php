<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ModalcodeController;
use App\Http\Controllers\AddDynamicRowsModalController;
use App\Http\Controllers\AddModalAjaxController;






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

// first time this route call and load view because we does not need any db data so we load view here.
Route::get('/', function () {
    return view('index');
});


Route::get('/loaditems', [ItemController::class, 'loaditems']);
Route::post('/items', [ItemController::class, 'store']);
Route::put('/items/{id}', [ItemController::class, 'update']);
Route::delete('/items/{id}', [ItemController::class, 'destroy']);



// ----------------- second way of ajax call -----------------

Route::get('/product', function () {
    return view('product');
});

Route::get('/fetch_product', [ProductController::class, 'fetch_product']);
Route::post('/add_product', [ProductController::class, 'add_product']);
Route::get('/edit_product/{id}', [ProductController::class, 'edit_product']);
Route::post('/update_product/{id}', [ProductController::class, 'update_product']);
Route::delete('/delete_product/{id}', [ProductController::class, 'delete_product']);




// ----------------- add more data using dynamic row with file upload -----------------
Route::get('/add_more', [FileController::class, 'index']);
Route::post('/upload-image', [FileController::class, 'store'])->name('upload.image');
Route::get('/edit-image/{id}', [FileController::class, 'editImage'])->name('edit.image');
Route::put('/update-image/{id}', [FileController::class, 'updateImage'])->name('update.image');
Route::delete('/delete-image/{id}', [FileController::class, 'deleteImage'])->name('delete.image');


// crud using moadal with simple one form
Route::get('/modal', [ModalcodeController::class, 'index']);
Route::post('/store-data', [ModalcodeController::class, 'store'])->name('store-data');
Route::put('/update-data/{id}', [ModalcodeController::class, 'update'])->name('update-data');
Route::delete('/delete-data/{id}', [ModalcodeController::class, 'delete'])->name('delete-data');


// crud using moadal with add more rows dynamiccaly
Route::get('/modal_dynamic_rows', [AddDynamicRowsModalController::class, 'index']);
Route::post('/store-data', [AddDynamicRowsModalController::class, 'store'])->name('store-data');
Route::put('/update-data/{id}', [AddDynamicRowsModalController::class, 'update'])->name('update-data');
Route::delete('/delete-data/{id}', [AddDynamicRowsModalController::class, 'delete'])->name('delete-data');


// crud using moadal with simple one form using ajax 
Route::get('/modal-ajax', [AddModalAjaxController::class, 'index']);
Route::post('/store-data-ajax', [AddModalAjaxController::class, 'store']);
Route::get('/get-data-ajax/{id}', [AddModalAjaxController::class, 'edit']);
Route::put('/update-data-ajax/{id}', [AddModalAjaxController::class, 'update']);
Route::delete('/delete-data-ajax/{id}', [AddModalAjaxController::class, 'destroy']);



