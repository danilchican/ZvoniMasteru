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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'Admin\HomeController@index')->name('admin.index');

    Route::get('/services/get/{count?}', 'Admin\ServicesController@getServices');
    Route::get('/specialities/get/{count?}', 'Admin\SpecialitiesController@getSpecialities');

    Route::resource('companies', 'Admin\CompaniesController', [
        'as' => 'admin',
    ]);
    Route::resource('tariffs', 'Admin\TariffsController', [
        'as' => 'admin',
    ]);
    Route::resource('services', 'Admin\ServicesController', [
        'as' => 'admin',
    ]);
    Route::resource('specialities', 'Admin\SpecialitiesController', [
        'as' => 'admin',
    ]);
});
