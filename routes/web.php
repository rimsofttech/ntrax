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

Route::get('/', function () {
    return redirect()->intended('/login');
});

// Route::get('{any}', 'UboldController@index');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(["prefix" => "admin", "namespace" => "Admin",'middleware' => 'auth'], function () {

    /********************************Role */

    Route::resource('role','RoleController');
    Route::post('role/update', 'RoleController@update')->name('role.update');
    Route::get('role/destroy/{id}', 'RoleController@destroy');
    Route::get('/search-permission', 'RoleController@searchPermission')->name('search.permission');

    /********************************Permission */

    Route::resource('permission','PermissionController');
    Route::post('permission/update', 'PermissionController@update')->name('permission.update');
    Route::get('permission/destroy/{id}', 'PermissionController@destroy');

    /********************************User */

    Route::resource('user','UserController');
    Route::post('user/update', 'UserController@update')->name('user.update');
    Route::get('user/destroy/{id}', 'UserController@destroy');
    Route::get('/search-role', 'UserController@searchRole')->name('search.role');

    /******************************Zone */

    Route::resource('zone','ZoneController');
    Route::post('zone/update', 'ZoneController@update')->name('zone.update');
    Route::get('zone/destroy/{id}', 'ZoneController@destroy');
    Route::get('/search-country/{keyword?}', 'ZoneController@searchCountry')->name('search.country');
    Route::get('/search-state/{keyword?}', 'ZoneController@searchState')->name('search.state');
    Route::get('/search-city/{keyword?}', 'ZoneController@searchCity')->name('search.city');

    /******************************Channel Patner */

    Route::resource('channelpartner','ChannelPartnerController');
    Route::post('channelpartner/update', 'ChannelPartnerController@update')->name('channelpartner.update');
    Route::get('channelpartner/destroy/{id}', 'ChannelPartnerController@destroy');
    Route::get('/search-channelpartnertype', 'ChannelPartnerController@searchChannelPartnerType')->name('search.channelpartnertype');

    Route::resource('channelpartnertype','ChannelPartnerTypeController');
    Route::post('channelpartnertype/update', 'ChannelPartnerTypeController@update')->name('channelpartnertype.update');
    Route::get('channelpartnertype/destroy/{id}', 'ChannelPartnerTypeController@destroy');

    Route::resource('product','ProductController');
    Route::post('product/update', 'ProductController@update')->name('product.update');
    Route::get('product/destroy/{id}', 'ProductController@destroy');
    

    Route::resource('subproduct','SubProductController');
    Route::post('subproduct/update', 'SubProductController@update')->name('subproduct.update');
    Route::get('subproduct/destroy/{id}', 'SubProductController@destroy');
    Route::get('/search-subproduct', 'SubProductController@searchProduct')->name('search.product');

    Route::resource('subsubproduct','SubSubProductController');
    Route::post('subsubproduct/update', 'SubSubProductController@update')->name('subsubproduct.update');
    Route::get('subsubproduct/destroy/{id}', 'SubSubProductController@destroy');
    Route::get('/search-subsubproduct', 'SubSubProductController@searchSubProduct')->name('search.subproduct');
    
});