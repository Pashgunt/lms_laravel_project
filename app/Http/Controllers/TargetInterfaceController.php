<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\CourseRepository;
use App\LMS\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TargetInterfaceController extends Controller
{
    protected UserRepository $userRepository;
    protected CourseRepository $courseRepository;

    public function __construct(UserRepository $userRepository, CourseRepository $courseRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
    }

    public function allInfo(): View
    {
        return view('interfaceForTarget', [
            'users' => $this->userRepository->all(),
            'courses' => $this->courseRepository->all()
        ]);
    }

    public function searchUser(Request $request): View
    {
        $value = $request->input('search_user');
        return view('interfaceForTarget', [
            'users' => $this->userRepository->searchUser($value),
            'courses' => $this->courseRepository->all(),
            'search' => $value,
        ]);
    }

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
