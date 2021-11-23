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

Route::get('/', function () {
    return view('index');
})->middleware(['auth'])->name('index');

Route::get('/users', function () {
    return view('index');
})->middleware(['auth', 'role:admin'])->name('users');

Route::get('/courses', function () {
    return view('index');
})->middleware(['auth', 'role:admin|manager'])->name('courses');

//(['auth', 'role:manager|admin'])->name('courses');

require __DIR__.'/auth.php';
