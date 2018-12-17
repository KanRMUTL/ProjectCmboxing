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
    Route::resource('ticket', 'marketing\TicketController');

    Route::prefix('chart')->group(function(){
        Route::get('/', 'marketing\ChartSaleController@index');
        Route::get('/data', 'marketing\ChartSaleController@getJson');//ทดสอบเฉยๆ
        Route::get('/zone/','marketing\ChartSaleController@zonePage'); //รายงานการขายแต่ละโซน
        Route::get('/zone/data','marketing\ChartSaleController@chartZone'); //รายงานการขายแต่ละโซน
    });

    });

Route::get('/logout', 'Auth\LoginController@logout'); // For logout
