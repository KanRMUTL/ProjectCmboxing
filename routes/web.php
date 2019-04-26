<?php

Auth::routes();
Route::auth();
Route::get('/', 'shopping\ShoppingController@index');
Route::get('/about', 'shopping\ShoppingController@about');
Route::resource('/booking', 'shopping\SeatController');
Route::get('/courses','shopping\CourseController@courses');
Route::group(['middleware' =>['auth']], function() {

    Route::get('/dashboard', 'PageController@index');
    
    Route::resource('user', 'UserController');
    Route::resource('ticket', 'marketing\TicketController');
    Route::resource('trainer', 'shopping\TrainerController');
    Route::resource('course', 'shopping\CourseController');
   
    // ข้อมูลการขายของพนักงานกับไกด์
    Route::prefix('sale')->group(function() {
        Route::get('/{saleTypeName}', 'marketing\SaleController@index')->name('sale.index'); 
        Route::post('/{saleTypeName}', 'marketing\SaleController@search')->name('sale.search'); // ค้นหา
        Route::post('/', 'marketing\SaleController@store')->name('sale.store');
        Route::match(['put', 'patch'], '/update/{id}', 'marketing\SaleController@update')->name('sale.update');
        Route::delete('/{id}', 'marketing\SaleController@destroy')->name('sale.destroy');
        Route::get('/{id}/edit', 'marketing\SaleController@edit')->name('sale.edit');
    });
    
    Route::post('saleReport', 'marketing\report\ReportController@saleReport')->name('report.sale');
    Route::post('EmpCommissionReport', 'marketing\report\ReportController@EmpCommissionReport')->name('report.empCommission');
    Route::post('guideCommissionReport', 'marketing\report\ReportController@guideCommissionReport')->name('report.guideCommission');


    Route::prefix('chart')->group(function() {
        Route::get('/', 'marketing\ChartSaleController@index');
    });

    //กราฟแท่ง
    Route::prefix('api')->group(function() {
        Route::get('/total','marketing\ChartSaleController@apiZoneTotal'); //รายงานการขายแบ่งตามยอดขาย
        Route::get('/customer','marketing\ChartSaleController@apiZoneCustomer'); //รายงานการขายแบ่งตามจำนวนลูกค้า
        Route::get('/ticket','marketing\ChartSaleController@apiTicket'); //รายงานการขายแบ่งตามประเภทบัตร
        Route::get('/amountcustomer','marketing\ChartSaleController@apiChartAmountCustomer'); //รายงานการขายแบ่งตามประเภทบัตร
    });

        Route::get('/income', 'marketing\IncomeController@income')->name('income.income');
        Route::post('/income', 'marketing\IncomeController@searchIncome')->name('income.searchIncome');

        Route::get('/commissionOfEmp', 'marketing\CommissionController@empCommission')->name('empCommission');
        Route::post('/commissionOfEmp', 'marketing\CommissionController@searchEmp')->name('empCommission.search');
        Route::get('/commissionOfGuide', 'marketing\CommissionController@guideCommission')->name('guideCommission');
        Route::post('/commissionOfGuide', 'marketing\CommissionController@searchguide')->name('guidecommission.search');

    Route::prefix('stock')->group(function() {
        Route::get('sale', 'pos\PosController@sale');
        Route::get('product', 'pos\PosController@product');
        Route::get('report', 'pos\PosController@saleReport');
    });
});

Route::get('/logout', 'Auth\LoginController@logout'); // For logout
