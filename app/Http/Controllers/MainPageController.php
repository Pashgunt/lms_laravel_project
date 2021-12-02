<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\AppointmentRepository;
use App\LMS\Repositories\CourseRepository;
use App\Models\Appointment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

/**
 * Класс для отображения главной страницы сайта
 */
class MainPageController
{
    protected AppointmentRepository $repository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->repository = $appointmentRepository;
    }

    /** Метод отображение базовой страницы  */
    public function main(): View
    {
        $user = Auth::user();
        $appointments = [];

        if (mb_strtolower($user->role->role_name) === Role::ROLE_USER) {
            $appointments = $this->repository->getByUser($user)->paginate(10);
        }

        return view('index', [
            'user' => $user,
            'appointments' => $appointments,
        ]);
    }
}
