<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\AppointmentRepository;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Контроллер прохождения курсов
 */
class PassingCourseController
{
    protected AppointmentRepository $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Course $course): View
    {
        return view('courseReader', [
            'course' => $course
        ]);
    }

    public function pass(Course $course)
    {
        $user = Auth::user();
        $this->repository->update(
            $this->repository->getBySubjects($user, $course),
            ['passed_at' => date('Y-m-d h:m:s')]
        );

        return redirect('/');
    }
}
