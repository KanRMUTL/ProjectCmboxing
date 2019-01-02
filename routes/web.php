<?php

Auth::routes();
Route::auth();
Route::group(['middleware' =>['auth']], function(){
    Route::get('/', 'PageController@index');
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