<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "site" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {

        route::group([ 'namespace' => 'Site','middleware' => 'auth:users'],function (){   //Visit the route authority



        });

           #######################################################################################


        route::group(['namespace' => 'Site','middleware' => 'guest:user'],function (){



        });


        route::get('/', function () {
            return view('front.home');
        });

    route::get('login', function () {
        return view('front.auth.login');
    });

    route::get('register', function () {
        return view('front.auth.register');
    });

    route::get('verification', function () {
        return view('front.auth.verification');
    });

    route::get('verify', function () {
        return view('front.auth.verify');
    });

});
