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

Route::get('hello',function(){
    return 'hello';
})->middleware('auth');

Route::group(['middleware' =>['web','auth']], function(){
    Route::get('/', function () {
        if(Auth::user()->permission == 0){
            return view('home');
        }
        return view('welcome');
    });

    Route::get('/home', function(){
        if(Auth::user()->permission == 4){
            return view('home');
        }
        else if(Auth::user()->permission == 1){
            return view('admin.index');
        }
        else if(Auth::user()->permission == 2){
            return view('mk_head.index');
        }
        else if(Auth::user()->permission == 3){
            return view('employee.index');
        }
    });
});

Route::resource('user', 'UserController');

// เช็คสิทธิ์ว่าเป็น อะไร
Route::get('isadmin',function(){
    return "Yes Is ADMIN";
})->middleware('admin');

Route::get('isemp',function(){
    return "Yes Is employee";
})->middleware('employee');

Route::get('ismkhead',function(){
    return "Yes Is mkhead";
})->middleware('mkhead');