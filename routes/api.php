<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/saling', 'Api\pos\SalingController@index'); // แสดงรายการสินค้าทั้งหมด
Route::get('/saling/{barcode}', 'Api\pos\SalingController@show'); // ค้นหาสินค้าด้วยบาร์โค้ด
Route::post('/saling', 'Api\pos\SalingController@store');  // บันทึกการขาย

Route::resource('/product', 'Api\pos\ProductController');
Route::post('/product/{id}', 'Api\pos\ProductController@updateProduct');
Route::resource('/report', 'Api\pos\ReportController');
Route::resource('/booking', 'Api\shopping\BookingController');
Route::post('/payment', 'Api\shopping\BookingController@payment');
Route::post('/booking/search', 'Api\shopping\BookingController@search');
Route::resource('/course', 'Api\shopping\CourseController');
Route::get('/trainer', 'Api\shopping\TrainerController@index');
Route::post('/user/{user_id}', 'Api\UserController@store'); // อัพเดทโปรไฟล์
Route::get('/user/{user_id}', 'Api\UserController@show'); // แก้ไขโปรไฟล์

Route::get('/customer/{user_id}', 'Api\UserController@showCustomer'); // แก้ไขโปรไฟล์
Route::post('/customer/{user_id}', 'Api\UserController@updateCustomer'); // แก้ไขโปรไฟล์

Route::resource('/courses', 'Api\shopping\CourseController');
Route::get('/webdetail', 'Api\Shopping\WebDetailController@index');
Route::PATCH('/webdetail/{id}', 'Api\Shopping\WebDetailController@update');
Route::resource('/fight', 'Api\shopping\FightController'); // โปสเตอร์การชกมวย

Route::resource('/registerCourse', 'Api\shopping\RegisterCourseController');
Route::get('/report_registerCourse', 'Api\shopping\RegisterCourseController@report');
Route::post('/report_registerCourse', 'Api\shopping\RegisterCourseController@report');
Route::get('/userProfile/{user_id}', 'Api\marketing\SaleController@show');
Route::post('/userProfile/{id}', 'Api\marketing\SaleController@show');
Route::post('/passwordreset/{id}', 'Api\UserController@passwordReseted');

Route::get('/getTicket', 'Api\shopping\ShoppingController@ticket');
Route::get('/showTicket/{id}', 'Api\shopping\ShoppingController@showTicket');
Route::get('/saleTicketOnline', 'Api\shopping\BookingController@searchSaleTicketOnline');
Route::post('/zoneSalingChart', 'Api\marketing\ChartController@zoneSaling');
Route::post('/ticketSalingChart', 'Api\marketing\ChartController@ticketSaling');
Route::post('/ticketSalingChart', 'Api\marketing\ChartController@ticketSaling');
Route::post('/ticketAmountSalingChart', 'Api\marketing\ChartController@ticketAmountSaling');


