<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('saling', 'Api\pos\SalingController');
Route::resource('product', 'Api\pos\ProductController');
Route::post('product/{id}', 'Api\pos\ProductController@updateProduct');
Route::resource('report', 'Api\pos\ReportController');
Route::resource('booking', 'Api\shopping\BookingController');
Route::post('/payment', 'Api\shopping\BookingController@payment');
Route::post('booking/search', 'Api\shopping\BookingController@search');
Route::resource('course', 'Api\shopping\CourseController');
Route::resource('trainer', 'Api\shopping\TrainerController');
Route::resource('user', 'Api\UserController');
Route::resource('courses', 'Api\shopping\CourseController');

Route::resource('registerCourse', 'Api\shopping\RegisterCourseController');
Route::resource('userProfile', 'Api\marketing\SaleController');

Route::get('getTicket', 'Api\shopping\ShoppingController@ticket');