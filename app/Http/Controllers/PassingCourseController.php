<?php

namespace App\Http\Controllers;

/*
 * Контроллер прохождения курсов
 */

use App\Models\Courses;
use Illuminate\View\View;

class PassingCourseController
{
    public function index(Courses $course): View
    {
        return view('courseReader', [
            'course' => $course
        ]);
    }

}
