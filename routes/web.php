<?php

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



Auth::routes();
Route::auth();
Route::group(['middleware' =>['auth']], function(){
    Route::get('/', function () {
        if(Auth::user()->role_id == 1){
            return view('admin.index');
        }
        else if(Auth::user()->role_id == 2){
            return view('mk_head.index');
        }
        else if(Auth::user()->role_id == 3){
            return view('employee.index');
        }
    });
});

Route::resource('user', 'UserController');
Route::resource('sale', 'marketing\SaleController');
Route::get('/logout', 'Auth\LoginController@logout'); // For logout