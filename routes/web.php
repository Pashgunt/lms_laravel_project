<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
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

Route::get('/', [MainPageController::class, 'main'])->middleware(['auth'])->name('index');


Route::resource('/courses', CourseController::class)->except(['destroy'])->middleware(['auth', 'role:admin|manager']);

Route::get('/courses/{id}/destroy', [CourseController::class, 'destroy'])->middleware(['auth', 'role:admin|manager']);

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/users/list/{page}', [\App\Http\Controllers\UsersListController::class, 'main']);

Route::get('/users/list', [\App\Http\Controllers\UsersListController::class, 'redirect']);

Route::post('/users/list/{page}', [\App\Http\Controllers\UsersListController::class, 'delete']);

Route::get('/users/edit/{userId}', [\App\Http\Controllers\UsersListController::class, 'editPage']);

Route::post('/users/edit/{userId}', [\App\Http\Controllers\UsersListController::class, 'editInfo']);

Route::get('/courses/activity/{activityId}', [\App\Http\Controllers\ActivitiesController::class, 'info']);

Route::get('/courses/{courseId}/activity/add', [\App\Http\Controllers\ActivitiesController::class, 'addPage']);


Route::get('/recovery', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');

Route::post('/recovery', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

