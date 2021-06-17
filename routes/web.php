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
        Route::post('/delete', 'BackController@delete')->name('admin.delete');
        Route::post('/deleteAll', 'BackController@deleteAll')->name('admin.deleteAll');
        Route::post('/search', 'BackController@search')->name('search');
    });
    Route::group([
        'prefix' => '/client',
    ], function() {
        //Route::get('/{id}', 'FrontController@form')->name('client.id');
        Route::get('/', 'FrontController@form')->name('client');
        Route::post('/thanks', 'FrontController@thanks')->name('client.thanks');
        Route::post('/delete', 'FrontController@delete')->name('client.delete');
        Route::post('/put', 'FrontController@put')->name('client.put');
    });
    Route::get('login', 'AuthController@index')->name('firstLogin');
    Route::post('login', 'AuthController@login')->name('login'); 
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::get('/', 'FrontController@form')->name('home');
});
