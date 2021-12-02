<?php

namespace App\Http\Controllers;

/*
 * Контроллер прохождения курсов
 */

use App\LMS\Repositories\AppointmentRepository;
use App\LMS\Repositories\CourseRepository;
use App\LMS\Repositories\CoursesActivitiesRepository;
use App\LMS\Repositories\UserRepository;
use App\Models\Courses;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PassingCourseController
{

    protected AppointmentRepository $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(Courses $course): View
    {
        return view('courseReader', [
            'course' => $course
        ]);
    }

    public function pass(Courses $course)
    {
        $user = Auth::user();
        $this->repository->update($this->repository->getBySubjects($user, $course),
                                  ['passed_at' => date('Y-m-d h:m:s')]);

        return redirect('/');
    }

}
