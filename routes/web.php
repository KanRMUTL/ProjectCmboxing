<?php

Auth::routes();
Route::auth();
Route::group(['middleware' =>['auth']], function(){
    Route::get('/', function () {
        if(Auth::user()->role_id == 1){
            return view('admin.index');
        }
        else if(Auth::user()->role_id == 2){
            return view('head.index');
        }
        else if(Auth::user()->role_id == 3){
            return view('employee.index');
        }
    });
    Route::resource('user', 'UserController');
    Route::resource('sale', 'marketing\SaleController');
    Route::get('/chart', 'marketing\ChartSaleController@index');
    Route::get('/chart/data', 'marketing\ChartSaleController@getJson');
});
Route::get('/logout', 'Auth\LoginController@logout'); // For logout

Route::get('/play','marketing\ChartSaleController@chartZone');