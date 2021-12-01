<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TargetInterfaceController;
use App\Http\Controllers\UsersListController;
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

/**
 * Маршруты авторизации
 */
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/**
 * Маршруты регистрации
 */
Route::get('/register', [PageRegisterUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');
Route::get('register/confirm/{email_verify_token}', [RegisteredUserController::class, 'confirmEmail'])
    ->middleware('guest');

/**
 * Маршруты восстановления пароля
 */
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

/**
 * Маршруты курсов
 */
Route::middleware(['auth', 'role:admin|manager'])->prefix('courses')->group(function () {
    Route::resource('', CourseController::class)->except(['destroy', 'edit', 'show'])
        ->names(['index' => 'courses', 'create' => 'createCourse']);
    Route::get('/{courseId}', [CourseController::class, 'show'])->name('courseDetail');
    Route::get('/{courseId}/destroy', [CourseController::class, 'destroy']);
    Route::get('/{courseId}/edit', [CourseController::class, 'edit'])->name('editCourse');
    Route::post('/{courseId}/edit', [CourseController::class, 'editCourse']);
    Route::get('/activity/{contentId}/edit-page', [ActivitiesController::class, 'editPage']);
    Route::get('/activity/{activityId}', [ActivitiesController::class, 'info']);
    Route::post('/activity/{activityId}/edit', [ActivitiesController::class, 'editActivity']);
    Route::get('/{courseId}/sort/{column}/{sort_type}', [ActivitiesController::class, 'getSortedList']);
    Route::get('/activity/{activityId}/delete', [ActivitiesController::class, 'delete']);
    Route::get('/{courseId}/activity/add', [ActivitiesController::class, 'addPage']);
    Route::post('/{courseId}/activity/add', [ActivitiesController::class, 'addActivity']);
    Route::get('/{courseId}/activity/add', [ActivitiesController::class, 'addPage']);
    Route::get('/activity/{activityId}/{event}', [ActivitiesController::class, 'changePriority']);
});

/**
 * Маршруты пользователей
 */
Route::middleware(['auth', 'role:admin'])->prefix('users')->group(function () {
    Route::get('/list', [UsersListController::class, 'main'])->name('users');
    Route::post('/list', [UsersListController::class, 'delete']);
    Route::get('/edit/{userId}', [UsersListController::class, 'editPage'])->name('userDetail');
    Route::post('/edit/{userId}', [UsersListController::class, 'editInfo'])->name('userDetail');
});

/**
 * Маршруты назначений
 */
Route::middleware(['auth', 'role:admin|manager'])->prefix('target')->group(function () {
    Route::get('', [TargetInterfaceController::class, 'show'])->name('target');
    Route::get('/students', [TargetInterfaceController::class, 'students'])->name('students');
    Route::get('/{target_id}/destroy', [TargetInterfaceController::class, 'destroy']);
});

/**
 * Маршруты назначений 2
 */
Route::middleware(['auth', 'role:admin|manager'])->prefix('target-interface')->group(function () {
    Route::get('', [TargetInterfaceController::class, 'allInfo']);
    Route::get('/{page_course}/{page_user}', [TargetInterfaceController::class, 'allInfo'])
        ->name('createTarget');
    Route::post('/{page_course}/{page_user}', [TargetInterfaceController::class, 'createAppointment']);
    Route::get('/search-users', [TargetInterfaceController::class, 'searchUser']);
    Route::get('/search-courses', [TargetInterfaceController::class, 'searchCourses']);
});

/**
 * Маршруты видео
 */
Route::prefix('video')->group(function () {
    // Тестовое видео
    Route::get('', [VideoController::class, 'play']);
    // Список загруженных видео
    Route::get('/list', [VideoController::class, 'list']);
    // Удаление видео по id
    Route::post('/delete/{id}', [VideoController::class, 'destroy'])
        ->middleware('auth')->middleware(['auth', 'role:admin|manager']);
    // Добавление видео
    Route::post('/add', [VideoController::class, 'store'])
        ->middleware('auth')->middleware(['auth', 'role:admin|manager']);
});
