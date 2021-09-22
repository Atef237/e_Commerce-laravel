<?php

use Illuminate\Support\Facades\Auth;
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

        route::group([ 'namespace' => 'Site\Auth','middleware' => 'auth:user' ],function (){   //Visit the route authority

            route::get('verification','VerificationCodeController@verification')->name('verification.form');

            route::post('verification','VerificationCodeController@PostVerification')->name('Verification.post');

        });

        route::group([ 'namespace' => 'Site','middleware' => ['auth:user','Verified_User'] ],function (){   //Visit the route authority and verified

            route::get('profile',function (){
                return Auth::guard('user')->user()->name ;
            })->name('profile');

        });

           #######################################################################################


        route::group(['namespace' => 'Site\Auth','middleware' => 'guest:user'],function (){


            route::get('register','RegisterController@getRegister');

            route::post('register','RegisterController@Register')->name('post.register');

                            ###############################################

            route::get('login','loginController@getLogin');

            route::post('login','loginController@postlogin')->name('post.login');


        });

    route::get('/','Site\HomeController@home')->name('/');

//        route::get('/', function () {
//            return view('front.home');
//        })->name('/');


    route::get('verify', function () {
        return view('front.auth.verify');
    });


});
