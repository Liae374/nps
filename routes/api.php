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
        Route::get('/{id}', 'NoteController@read')->name('note.read');
        Route::get('/', 'NoteController@index')->name('note.index');
        Route::put('/{id}', 'NoteController@update')->name('note.update');
        Route::delete('/{id}', 'NoteController@delete')->name('note.delete');
    });
    Route::group([
        'prefix' => 'client'
    ], function() {
        Route::post('/', 'ClientController@create')->name('client.create');
        Route::get('/{id}', 'ClientController@read')->name('client.read');
        Route::delete('/{id}', 'ClientController@delete')->name('client.delete');
        Route::get('/', 'ClientController@index')->name('client.index');
        Route::post('/{id}', 'NoteController@create')->name('note.create');
    });
});
