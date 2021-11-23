<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPageController;
use \App\Http\Controllers\CourseController;

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
    return view('index');
})->middleware(['auth'])->name('index');

Route::get('/users', function () {
    return view('index');
})->middleware(['auth', 'role:admin'])->name('users');

Route::get('/courses', function () {
    return view('index');
})->middleware(['auth', 'role:admin|manager'])->name('courses');

Route::get('/users/list/{page}', '\App\Http\Controllers\UsersListController@main');
Route::post('/users/list/{page}', '\App\Http\Controllers\UsersListController@delete');
Route::get('/users/edit/{userId}', '\App\Http\Controllers\UsersListController@editPage');
Route::post('/users/edit/{userId}', '\App\Http\Controllers\UsersListController@editInfo');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

