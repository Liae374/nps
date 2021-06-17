<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'namespace' => '\App\Http\Controllers'
], function() {
    Route::post('create', 'ApiController@create');
    Route::get('create', 'ApiController@create');
    Route::post('read', 'ApiController@read');
    Route::get('read', 'ApiController@read');
    Route::post('update', 'ApiController@update');
    Route::get('update', 'ApiController@update');
    Route::post('delete', 'ApiController@delete');
    Route::get('delete', 'ApiController@delete');
});
