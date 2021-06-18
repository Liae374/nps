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
        Route::get('/{ID}', 'NoteController@read');
        Route::get('/', 'NoteController@readAll');
        Route::put('/{ID}', 'NoteController@update');
        Route::delete('/{ID}', 'NoteController@delete');
    });
    Route::group([
        'prefix' => 'client'
    ], function() {
        Route::post('/{ID}', 'ClientController@create');
        Route::get('/', 'ClientController@readAll');
        Route::get('/{ID}', 'ClientController@read');
        Route::delete('/{ID}', 'ClientController@delete');
        Route::post('/{ID}/note', 'NoteController@create');
    });
});
