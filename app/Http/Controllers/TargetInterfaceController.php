<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\CourseRepository;
use App\LMS\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Контроллер для назначения курсов
 */
class TargetInterfaceController extends Controller
{
    protected UserRepository $userRepository;
    protected CourseRepository $courseRepository;

    public function __construct(UserRepository $userRepository, CourseRepository $courseRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
    }

    /**
     * Вывод всех допустимых пользователей и курсов
     */
    public function allInfo(): View
    {
        return view('interfaceForTarget', [
            'users' => $this->userRepository->all(),
            'courses' => $this->courseRepository->all()
        ]);
    }

    /**
     * Метод для поиска по пользователям
     */
    public function searchUser(Request $request): View
    {
        $value = $request->input('search_user');
        return view('interfaceForTarget', [
            'users' => $this->userRepository->searchUser($value),
            'courses' => $this->courseRepository->all(),
            'search' => $value,
        ]);
    }

    /**
     * Метод для поиска по курсам
     */
    public function searchCourses(Request $request): View
    {
        $value = $request->input('search_course');
        return view('interfaceForTarget', [
            'users' => $this->userRepository->all(),
            'courses' => $this->courseRepository->searchCourse($value),
            'search' => $value,
        ]);
    }

}
