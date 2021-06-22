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
    'namespace' => '\App\Http\Controllers\Api',
], function() {
    Route::group([
        'prefix' => 'note'
    ], function() {
        Route::get('/{id}', 'NoteController@read');
        Route::get('/', 'NoteController@index');
        Route::put('/{id}', 'NoteController@update');
        Route::delete('/{id}', 'NoteController@delete');
    });
    Route::group([
        'prefix' => 'client'
    ], function() {
        Route::post('/', 'ClientController@create');
        Route::get('/{id}', 'ClientController@read');
        Route::delete('/{id}', 'ClientController@delete');
        Route::get('/', 'ClientController@index');
        Route::post('/{id}', 'NoteController@create');
    });
});
