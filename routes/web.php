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

Route::get('/admin', ['App\Http\Controllers\BackController', 'admin']);
Route::post('/admin/delete', ['App\Http\Controllers\BackController', 'delete']);

Route::get('/client/{id}', ['App\Http\Controllers\FrontController', 'form']);
Route::post('/client', ['App\Http\Controllers\FrontController', 'form']);
Route::get('/client', ['App\Http\Controllers\FrontController', 'authentication']);

Route::post('/thanks', ['App\Http\Controllers\FrontController', 'thanks']);

Route::get('/', ['App\Http\Controllers\FrontController', 'authentication']);

Route::post('/client/delete', ['App\Http\Controllers\FrontController', 'delete'])->name('client.delete');
Route::post('/client/put', ['App\Http\Controllers\FrontController', 'put']);