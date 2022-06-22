<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('dashboard.home'));
});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::name('dashboard.')->namespace('App\Http\Controllers\Dashboard')->middleware(['language', 'auth'])->prefix('dashboard')->group(function () {

    Route::get('/', function () {
        return redirect(route('dashboard.home'));
    });
    Route::get('lang-ar', function () {
        session()->put('lang', 'ar');
        return back();
    })->name('lang-ar');

    Route::get('lang-en', function () {
        session()->put('lang', 'en');
        return back();
    })->name('lang-en');

    Route::get('home', 'HomeController@index')->name('home');

    Route::put('home/update/{id}', 'HomeController@update')->name('home.update');
    Route::get('home/edit', 'HomeController@edit')->name('home.edit');

    Route::get('switch-theme', 'UserController@switchTheme')->name('switch-theme');




    Route::resource('users', 'UserController');


    Route::get('archive-users','UserController@indexArchive')->name('archive-users');


    Route::put('restore-user/{id}','UserController@restore')->name('restore-user');

    Route::post('users/suspend/{id}','UserController@suspend')->name('users.suspend');


    Route::post('users/approve/{id}','UserController@approve')->name('users.approve');

    Route::post('users/disapprove/{id}','UserController@disapprove')->name('users.disapprove');


    Route::resource('clients', 'ClientController');


    Route::get('archive-clients','ClientController@indexArchive')->name('archive-clients');


    Route::put('restore-client/{id}','ClientController@restore')->name('restore-client');

    Route::post('clients/suspend/{id}','ClientController@suspend')->name('clients.suspend');


    Route::post('clients/approve/{id}','ClientController@approve')->name('clients.approve');

    Route::post('clients/disapprove/{id}','ClientController@disapprove')->name('clients.disapprove');

    Route::resource('providers', 'ProviderController');


    Route::get('archive-providers','ProviderController@indexArchive')->name('archive-providers');


    Route::put('restore-provider/{id}','ProviderController@restore')->name('restore-provider');

    Route::post('providers/suspend/{id}','ProviderController@suspend')->name('providers.suspend');


    Route::post('providers/approve/{id}','ProviderController@approve')->name('providers.approve');

    Route::post('providers/disapprove/{id}','ProviderController@disapprove')->name('providers.disapprove');

    Route::resource('orders', 'OrderController')->only(['index','show']);
    Route::resource('sliders', 'SliderController');
    Route::resource('pages', 'PageController');

    Route::resource('contacts', 'ContactUsController');

    Route::resource('cities', 'CityController');

    Route::resource('system-options', 'OptionController')->only([
        'index', 'edit','update'
    ]);

    Route::resource('offers', 'OfferController');
    Route::resource('orders', 'OrderController');

    Route::resource('categories', 'CategoryController');
    Route::resource('sub-categories', 'SubCategoryController');
    Route::resource('equipments', 'EquipmentController');
    Route::resource('brands', 'BrandController');


});
