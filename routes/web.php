<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TargetInterfaceController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPageController;
use \App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\PageRegisterUserController;

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

Route::get('/', [MainPageController::class, 'main'])
    ->middleware(['auth'])
    ->name('index');

Route::resource('/courses', CourseController::class)
    ->except(['destroy', 'edit'])
    ->middleware(['auth', 'role:admin|manager']);

Route::get('/courses/{courseId}/destroy', [CourseController::class, 'destroy'])
    ->middleware(['auth', 'role:admin|manager']);

Route::get('/courses/{courseId}/edit', [CourseController::class, 'edit'])
    ->middleware(['auth', 'role:admin|manager']);

Route::post('/courses/{courseId}/edit', [CourseController::class, 'editCourse'])
    ->middleware(['auth', 'role:admin|manager']);

Route::get('/register', [PageRegisterUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('/users/list/{page}', [\App\Http\Controllers\UsersListController::class, 'main']);

Route::get('/users/list', [\App\Http\Controllers\UsersListController::class, 'redirect']);

Route::post('/users/list/{page}', [\App\Http\Controllers\UsersListController::class, 'delete']);

Route::get('/users/edit/{userId}', [\App\Http\Controllers\UsersListController::class, 'editPage'])
    ->middleware(['auth', 'role:admin']);

Route::post('/users/edit/{userId}', [\App\Http\Controllers\UsersListController::class, 'editInfo'])
    ->middleware(['auth', 'role:admin']);

Route::get('/courses/activity/{activityId}', [\App\Http\Controllers\ActivitiesController::class, 'info']);

Route::get('/courses/activity/{activityId}/edit', [\App\Http\Controllers\ActivitiesController::class, 'editPage']);

Route::get('/courses/{courseId}/sort/{column}/{sort_type}', [\App\Http\Controllers\ActivitiesController::class, 'getSortedList']);

Route::post('/courses/activity/{activityId}/edit', [\App\Http\Controllers\ActivitiesController::class, 'editActivity']);

Route::get('/courses/activity/{activityId}/delete', [\App\Http\Controllers\ActivitiesController::class, 'delete'])
    ->middleware(['auth', 'role:admin|manager']);

Route::get('/courses/{courseId}/activity/add', [\App\Http\Controllers\ActivitiesController::class, 'addPage'])
    ->middleware(['auth', 'role:admin|manager']);

Route::post('/courses/{courseId}/activity/add', [\App\Http\Controllers\ActivitiesController::class, 'addActivity'])
    ->middleware(['auth', 'role:admin|manager']);

Route::get('/courses/{courseId}/activity/add', [\App\Http\Controllers\ActivitiesController::class, 'addPage'])
    ->middleware(['auth', 'role:admin|manager']);

Route::get('/recovery', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/recovery', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


Route::get('/target-interface/{page_course}/{page_user}', [TargetInterfaceController::class, 'allInfo'])->middleware(['auth', 'role:admin|manager']);;

Route::post('/target-interface/{page_course}/{page_user}', [TargetInterfaceController::class, 'createAppointment'])->middleware(['auth', 'role:admin|manager']);;

Route::get('/target/user/search', [TargetInterfaceController::class, 'searchUser'])->middleware(['auth', 'role:admin|manager']);;

Route::get('/target/course/search', [TargetInterfaceController::class, 'searchCourses'])->middleware(['auth', 'role:admin|manager']);;

Route::get('/target', [TargetInterfaceController::class, 'show'])->middleware(['auth', 'role:admin|manager']);;
Route::get('/target/{target_id}/destroy', [TargetInterfaceController::class, 'destroy'])->middleware(['auth', 'role:admin|manager']);;

Route::get('/video', [VideoController::class, 'play']);
