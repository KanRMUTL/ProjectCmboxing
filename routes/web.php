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
    
    // ข้อมูลการขายของพนักงานกับไกด์
    Route::get('/saleByEmployee', 'marketing\SaleController@getByEmployee')->name('getSaleByEmp');
    Route::post('/saleByEmployee', 'marketing\SaleController@searchByEmployee')->name('searchSaleByEmp');
    Route::post('/saleByGuide', 'marketing\SaleController@searchByEmployee')->name('getSaleByEmp');
    

    Route::prefix('chart')->group(function(){
        Route::get('/', 'marketing\ChartSaleController@index');
    });

    Route::prefix('api')->group(function(){
        Route::get('/total','marketing\ChartSaleController@apiZoneTotal'); //รายงานการขายแบ่งตามยอดขาย
        Route::get('/customer','marketing\ChartSaleController@apiZoneCustomer'); //รายงานการขายแบ่งตามจำนวนลูกค้า
        Route::get('/ticket','marketing\ChartSaleController@apiTicket'); //รายงานการขายแบ่งตามประเภทบัตร
    });
    Route::prefix('commission')->group(function(){
        Route::get('/', 'marketing\CommissionController@empCommission');
        Route::post('/search', 'marketing\CommissionController@searchCommission')->name('commission.search');
    });
});

Route::get('/logout', 'Auth\LoginController@logout'); // For logout