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

Route::get('/', '\App\Http\Controllers\MainPageController@main');
Route::post('/', '\App\Http\Controllers\MainPageController@main');
Route::get('/login', '\App\Http\Controllers\LoginController@main');
Route::post('/login', '\App\Http\Controllers\LoginController@getAuthorization');
Route::get('/register', '\App\Http\Controllers\RegisterController@main');
Route::post('/register', '\App\Http\Controllers\RegisterController@getReg');
Route::get('/recovery', '\App\Http\Controllers\RecoveryController@main');
Route::post('/recovery', '\App\Http\Controllers\RecoveryController@getRecovery');
