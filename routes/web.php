<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group([
    'namespace' => '\App\Http\Controllers'
], function() {
    Route::group([
        'prefix' => '/admin',
        'middleware' => 'auth'
    ], function() {
        Route::get('/','BackController@admin')->name('admin');
        Route::post('/deleteNote/{id}', 'BackController@deleteNote')->name('admin.deleteNote');
        Route::post('/deleteClient/{id}', 'BackController@deleteClient')->name('admin.deleteClient');
        Route::post('/deleteAll', 'BackController@deleteAll')->name('admin.deleteAll');
        Route::post('/search', 'BackController@search')->name('search');
    });
    Route::group([
        'prefix' => '/client',
    ], function() {
        Route::get('/{id}', 'FrontController@form')->name('client');
        Route::post('/', 'FrontController@form')->name('client');
        Route::get('/', 'FrontController@authentication')->name('authentication');
        Route::post('/thanks/{id_client}', 'FrontController@thanks')->name('client.thanks');
        Route::post('/delete/{id}', 'FrontController@destroy')->name('client.destroy');
        Route::post('/update/{id_client}', 'FrontController@update')->name('client.update');
    });
    Route::get('login', 'AuthController@index')->name('login');
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::get('/', 'FrontController@authentication')->name('home');
    //Route::get('registrationClient', 'BackController@registrationClient')->name('register-client');
    Route::post('registrationClient', 'BackController@registeredClient')->name('register-client');
    //Route::get('registrationAdmin', 'AuthController@registration')->name('register-admin');
    //Route::post('registrationAdmin', 'AuthController@registered')->name('register-admin'); 
});
