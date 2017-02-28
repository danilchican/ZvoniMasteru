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
    Route::post('/categories/attach', 'Account\CategoryController@attachCategories');
    Route::get('/info', 'Account\AccountController@getAccountInfo');
    Route::post('/info/update', 'Account\AccountController@updateMainInfo');
    Route::post('/socials/update', 'Account\AccountController@updateSocials');
    Route::post('/contacts/update', 'Account\AccountController@updateContacts');
    Route::post('/phones/store', 'Account\PhoneController@createPhone');
    Route::post('/phones/update', 'Account\PhoneController@updatePhone');
    Route::get('/phones/list', 'Account\PhoneController@getPhones');
    Route::get('/reviews/get', 'Account\ReviewController@getReviews');
    Route::delete('/phones/{id}', 'Account\PhoneController@deletePhone');
    Route::get('/{settings?}', 'Account\AccountController@index')->name('account.index');
});


Route::group(['middleware' => 'published'], function () {
    Route::get('/companies/{slug}', 'CompanyController@cart')->name('company.cart');
    Route::post('/reviews/create', 'ReviewController@store')->name('reviews.store');
});
Route::get('/{category}', 'CategoryController@show')->name('category.show');