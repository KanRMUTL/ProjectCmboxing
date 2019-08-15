<?php

Auth::routes();
Route::auth();
Route::get('/', 'shopping\ShoppingController@index');
Route::get('/about', 'shopping\ShoppingController@about');
Route::resource('/booking', 'shopping\SeatController');
Route::get('/courses','shopping\CourseController@courses');
Route::post('/customerRegister', 'shopping\ShoppingController@register');

Route::group(['middleware' =>['auth']], function() {
    
    Route::get('/saleticket/{id}', 'shopping\ShoppingController@saleTicket');

    Route::get('/dashboard', 'PageController@index');
    Route::get('/employeeProfile/{id}', 'marketing\SaleController@employeeProfile');
    
    Route::get('/resetpassword', 'UserController@resetPassword');
    Route::resource('/user', 'UserController');
    Route::resource('/ticket', 'marketing\TicketController');
    Route::get('/course', 'shopping\CourseController@index'); // หน้าจัดการคอร์สของแอดมิน
    Route::get('/course/{user_id}', 'shopping\CourseController@show'); // ลูกค้าดูรายละเอียดการซื้อคอร์ส
    Route::get('/course_report', 'shopping\ShoppingController@reportCourse'); // ลูกค้าดูรายละเอียดการซื้อคอร์ส
    Route::get('/course/{start}/{end}', 'shopping\report\ReportController@courseRegister');
    // ครูสอนมวยไทย
    Route::get('/trainer', 'shopping\TrainerController@index');
    Route::post('/trainer', 'shopping\TrainerController@store');
    Route::get('/trainer/{id}/edit', 'shopping\TrainerController@edit');
    Route::put('/trainer/{id}', 'shopping\TrainerController@update');
    Route::delete('/trainer/{id}', 'shopping\TrainerController@destroy');

    // ข้อมูลการขายของพนักงานกับไกด์
    Route::prefix('/sale')->group(function() {
        Route::get('/{saleTypeName}', 'marketing\SaleController@index')->name('sale.index'); 
        Route::post('/{saleTypeName}', 'marketing\SaleController@search')->name('sale.search'); // ค้นหา
        Route::post('/', 'marketing\SaleController@store')->name('sale.store');
        Route::match(['put', 'patch'], '/update/{id}', 'marketing\SaleController@update')->name('sale.update');
        Route::delete('/{id}', 'marketing\SaleController@destroy')->name('sale.destroy');
        Route::get('/{id}/edit', 'marketing\SaleController@edit')->name('sale.edit');
    });
    
    Route::post('/saleReport', 'marketing\report\ReportController@saleReport')->name('report.sale');
    Route::post('/EmpCommissionReport', 'marketing\report\ReportController@EmpCommissionReport')->name('report.empCommission');
    Route::post('/guideCommissionReport', 'marketing\report\ReportController@guideCommissionReport')->name('report.guideCommission');
    Route::get('/salingReport','marketing\report\ReportController@sampleRreport');

    Route::get('/chart', 'marketing\ChartSaleController@index');

    Route::get('/income', 'marketing\IncomeController@income')->name('income.income');
    Route::post('/income', 'marketing\IncomeController@searchIncome')->name('income.searchIncome');
    Route::post('/incomeReport', 'marketing\report\ReportController@incomeReport');

    Route::get('/commissionOfEmp', 'marketing\CommissionController@empCommission')->name('empCommission');
    Route::post('/commissionOfEmp', 'marketing\CommissionController@searchEmp')->name('empCommission.search');
    Route::get('/commissionOfGuide', 'marketing\CommissionController@guideCommission')->name('guideCommission');
    Route::post('/commissionOfGuide', 'marketing\CommissionController@searchguide')->name('guidecommission.search');

    Route::prefix('/stock')->group(function() {
        Route::get('/sale', 'pos\PosController@sale');
        Route::get('/product', 'pos\PosController@product');
        Route::get('/report', 'pos\PosController@saleReport');
        Route::get('/bill/{id}', 'pos\ReportController@bill');
        Route::get('/allbills/{start}/{end}', 'pos\ReportController@allBills');
    });

    Route::get('/userprofile','shopping\ShoppingController@profile');
    Route::get('/customer_resetpassword', 'shopping\ShoppingController@resetpassword');
});

Route::get('/logout', 'Auth\LoginController@logout'); // For logout
