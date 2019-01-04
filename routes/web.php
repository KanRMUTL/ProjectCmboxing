<?php

Auth::routes();
Route::auth();
Route::group(['middleware' =>['auth']], function(){
    Route::get('/', 'PageController@index');
    Route::resource('user', 'UserController');
    Route::resource('ticket', 'marketing\TicketController');
    
   
    // ข้อมูลการขายของพนักงานกับไกด์
    Route::prefix('sale')->group(function(){
        Route::get('/{saleTypeName}', 'marketing\SaleController@index')->name('sale.index'); 
        Route::post('/{saleTypeName}', 'marketing\SaleController@search')->name('sale.search'); // ค้นหา
        Route::post('/sale', 'marketing\SaleController@store')->name('sale.store');
        Route::match(['put', 'patch'], '/update/{id}', 'marketing\SaleController@update')->name('sale.update');
        Route::delete('/{id}', 'marketing\SaleController@destroy')->name('sale.destroy');
        Route::get('/{id}/edit', 'marketing\SaleController@edit')->name('sale.edit');
    });


    Route::prefix('chart')->group(function(){
        Route::get('/', 'marketing\ChartSaleController@index');
    });

    Route::prefix('api')->group(function(){
        Route::get('/total','marketing\ChartSaleController@apiZoneTotal'); //รายงานการขายแบ่งตามยอดขาย
        Route::get('/customer','marketing\ChartSaleController@apiZoneCustomer'); //รายงานการขายแบ่งตามจำนวนลูกค้า
        Route::get('/ticket','marketing\ChartSaleController@apiTicket'); //รายงานการขายแบ่งตามประเภทบัตร
        Route::get('/amountcustomer','marketing\ChartSaleController@apiChartAmountCustomer'); //รายงานการขายแบ่งตามประเภทบัตร
    });
    
        Route::get('/commissionOfEmp', 'marketing\CommissionController@empCommission')->name('empCommission');
        Route::post('/commissionOfEmp', 'marketing\CommissionController@searchEmp')->name('empCommission.search');
        Route::get('/commissionOfGuide', 'marketing\CommissionController@guideCommission')->name('guideCommission');
        Route::post('/commissionOfGuide', 'marketing\CommissionController@searchguide')->name('guidecommission.search');
    

    Route::prefix('pdf')->group(function(){
        Route::get('/', 'PdfController@index');
    });
});

Route::get('/logout', 'Auth\LoginController@logout'); // For logout

Route::get('play', function(){
    
});