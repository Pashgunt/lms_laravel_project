<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRepository extends Repositories
{
    public function editCourseInfo(Request $request, int $id)
    {
        $this->model->where('id', '=', "$id")->update(["name" => $request->input('nameCourse'),
            "description" => strip_tags($request->input('descCourse')),
        ]);
    }
}
