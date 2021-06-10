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

Route::get('/admin', ['App\Http\Controllers\AdminController', 'Admin']);

Route::get('/client/{id}', ['App\Http\Controllers\ClientController', 'client']);
Route::post('/client', ['App\Http\Controllers\ClientController', 'client']);

Route::post('/thanks', ['App\Http\Controllers\ClientController', 'thanks']);

Route::get('/', ['App\Http\Controllers\ClientController', 'authentication']);
