<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

/**
 * Класс для отображения главной страницы сайта
 */
class MainPageController
{
    /** Метод отображение базовой страницы  */
    public function main(): View
    {
        $user = Auth::user();
        $appointmentCourses = [];
        if (mb_strtolower($user->role->role_name) === Role::ROLE_USER) {
            foreach ($user->appointments as $appointment) {
                $appointmentCourses[] = $appointment->course->first();
            }
        }

        return view('index', [
            'user' => $user,
            'appointmentCourses' => $appointmentCourses,
        ]);
    }

    public function admin(): RedirectResponse
    {
        return redirect('users');
    }
}
