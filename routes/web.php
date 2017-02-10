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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'dashboard'], function () {
    Route::get('/', 'Admin\HomeController@index')->name('admin.index');

    Route::get('/services/get/{count?}', 'Admin\ServiceController@getServices');
    Route::post('/specialities/search', 'Admin\SpecialityController@search');
    Route::get('/specialities/get/{count?}', 'Admin\SpecialityController@getSpecialities');

    Route::resource('companies', 'Admin\CompanyController', ['as' => 'admin']);
    Route::resource('tariffs', 'Admin\TariffController', ['as' => 'admin']);
    Route::resource('services', 'Admin\ServiceController', ['as' => 'admin']);
    Route::resource('specialities', 'Admin\SpecialityController', ['as' => 'admin']);
    Route::resource('categories', 'Admin\CategoryController', ['as' => 'admin']);
});

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'account'], function () {
    Route::get('/categories/list', 'Account\CategoryController@getCategories');
    Route::get('/categories/attached', 'Account\CategoryController@getAttachedCategories');
    Route::post('/categories/toggle', 'Account\CategoryController@toggleCategory');
    Route::get('/info', 'Account\AccountController@getAccountInfo');
    Route::post('/info/update', 'Account\AccountController@updateMainInfo');
    Route::post('/socials/update', 'Account\AccountController@updateSocials');
    Route::get('/{settings?}', 'Account\AccountController@index')->name('account.index');
});