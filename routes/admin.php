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

        route::get('logout','loginCon@logout')->name('admin.logout');

        route::get('/','dashboardCon@index')->name('admin.dashboard');  //3 لينك عرض لوحه التحكم

        route::group(['prefix' => 'settings'], function(){

            route::get('shipping-methods-{type}','settingsCon@editShippingMethods')->name('edit.shippings.methods');

            route::put('shipping-methods/{id}','settingsCon@updateShippingMethods')->name('update.shippings.methods');

        });

        route::group(['prefix' => 'profile'] , function(){

            route::get('edit' , 'profileCon@showprofile')->name('show.profile');

            route::put('update' , 'profileCon@updateprofile')->name('update.profile');

        });

        ////////////////////////////////////// begin categories routes ////////////////////////////////////

        route::group(['prefix' => 'main_categories'],function(){
           route::get('/','MainCategoriesCon@index')->name('main_categories');
           route::get('create','MainCategoriesCon@create')->name('main_categories.create');
           route::post('store','MainCategoriesCon@store')->name('main_categories.store');
           route::get('edit/{id}','MainCategoriesCon@edit')->name('main_categories.edit');
           route::post('update/{id}','MainCategoriesCon@update')->name('main_categories.update');
           route::get('delete/{id}','MainCategoriesCon@destroy')->name('main_categories.delete');
        });

        ////////////////////////////////////////// end categories routes ////////////////////////////////////



        ////////////////////////////////////// begin sub categories routes ////////////////////////////////////

//        route::group(['prefix' => 'sub_categories'],function(){
//            route::get('/','subCategoriesCon@index')->name('sub_categories');
//            route::get('create','subCategoriesCon@create')->name('sub_categories.create');
//            route::post('store','subCategoriesCon@store')->name('sub_categories.store');
//            route::get('edit/{id}','subCategoriesCon@edit')->name('sub_categories.edit');
//            route::post('update/{id}','subCategoriesCon@update')->name('sub_categories.update');
//            route::get('delete/{id}','subCategoriesCon@destroy')->name('sub_categories.delete');
//        });

        ////////////////////////////////////////// end sub categories routes ////////////////////////////////////


        ////////////////////////////////////// begin Brands routes ////////////////////////////////////

        route::group(['prefix' => 'brand'],function(){
            route::get('/','BrandsCon@index')->name('Brands');
            route::get('create','BrandsCon@create')->name('Brand.create');
            route::post('store','BrandsCon@store')->name('Brand.store');
            route::get('edit/{id}','BrandsCon@edit')->name('Brand.edit');
            route::post('update/{id}','BrandsCon@update')->name('Brand.update');
            route::get('delete/{id}','BrandsCon@destroy')->name('Brand.delete');
        });

        ////////////////////////////////////////// end Brands routes ////////////////////////////////////


        ////////////////////////////////////////// begin tag route ///////////////////////////////////////

            //route::resource('tag','tagController');

        route::group(['prefix' => 'tag'],function(){
            route::get('/','tagController@index')->name('tags');
            route::get('create','tagController@create')->name('tag.create');
            route::post('store','tagController@store')->name('tag.store');
            route::get('edit/{id}','tagController@edit')->name('tag.edit');
            route::post('update/{id}','tagController@update')->name('tag.update');
            route::get('delete/{id}','tagController@destroy')->name('tag.delete');
        });


        ////////////////////////////////////////// end tag route ///////////////////////////////////////


        /////////////////////////////////////////begin products /////////////////////////////////////////


        route::group(['prefix' => 'product'],function(){
            route::get('/','productController@index')->name('products');

            route::get('create','productController@create')->name('product.create');
            route::post('store','productController@store')->name('product.store');

            route::get('price/{id}','productController@getPrice')->name('product.getPrice');
            route::post('price','productController@storePrice')->name('product.price.store');

            route::get('inventory/{id}','productController@addInventory')->name('inventory');
            route::post('add','productController@storeInventory')->name('storeInventory');


            route::get('image/{id}','productController@addImage')->name('addImage');
            route::post('storeImage','productController@storeImage')->name('store.image');
            route::post('save','productController@saveForm')->name('save');


        });

        /////////////////////////////////////////end product ///////////////////////////////////////////



        route::group(['prefix'=>'attribute'],function (){

            route::get('/','AttributeController@index')->name('attribute');
            route::get('create','AttributeController@create')->name('create.attribute');
            route::post('store','AttributeController@store')->name('store.attribute');
            route::get('destroy/{id}','AttributeController@destroy')->name('destroy.attribute');
            route::get('edit/{id}','AttributeController@edit')->name('edit.attribute');
            route::post('update/{id}','AttributeController@update')->name('update.attribute');

        });

    });


    route::group(['namespace' => 'Admin' , 'middleware' => 'guest:admin', 'prefix' => 'admin' ], function(){

        route::get('login','loginCon@login')->name('admin.login');             //  1 اللينك اللي بيطلبة الادمن عشان يدخل لفورم التسجيل

        route::post('login','loginCon@postLogin')->name('admin.post.login');   // 2 فورم التسجيل بتبعت البيانات علي اللينك ده عشان يتبعت الكنترولر يتعمل علية عمليات التحقق والتسجيل لو مسجل هتيتبعت للينك رقم 3 عشان يعرض لوحة التحكم

    });
});
