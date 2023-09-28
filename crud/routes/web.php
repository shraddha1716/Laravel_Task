<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCRUDController;
use GuzzleHttp\Psr7\Request;


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
Route::resource('companies', CompanyCRUDController::class);
Route::post('companies/delete_selected_record', [CompanyCRUDController::class,'delete_selected'])->name('companies.multiple_delete');



// -------------------------------------- session -----------------------------------
Route::get('/get_session',function(){
    $id = session('id');
    $name = session('name');
    dd($id,$name);
});

// ----------- set session --------------------

Route::get('/set_session',function(){
    session(['id' => '123','name'=>'shraddha']);
    echo "set session";
    return redirect('get_session');
});

// ------- forget(delete particulat session) session ---------

Route::get('forget_session',function(){
    session()->forget('id');
    return redirect('get_session');
});


// ------- flush(delete all session value) session ---------

Route::get('flush_session',function(){
    session()->flush();
    return redirect('get_session');
});