<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

// you can put prefix(admin) in RouteServiceProvider file

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    route::group(['namespace' => 'Admin' , 'middleware' => 'auth:admin', 'prefix' => 'admin' ], function(){

        route::get('/','dashboardCon@index')->name('admin.dashboard');  //3 لينك عرض لوحه التحكم

        

    });


    route::group(['namespace' => 'Admin' , 'middleware' => 'guest:admin', 'prefix' => 'admin' ], function(){

        route::get('login','loginCon@login')->name('admin.login');             //  1 اللينك اللي بيطلبة الادمن عشان يدخل لفورم التسجيل  

        route::post('login','loginCon@postLogin')->name('admin.post.login');   // 2 فورم التسجيل بتبعت البيانات علي اللينك ده عشان يتبعت الكنترولر يتعمل علية عمليات التحقق والتسجيل لو مسجل هتيتبعت للينك رقم 3 عشان يعرض لوحة التحكم

    });
});