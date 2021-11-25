<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Репозиторий для работы с методами для предназначенных для курсов
 */
class CourseRepository extends Repositories
{
    /**
     * Метод редактирования данных курса
     */
    public function editCourseInfo(Request $request, Courses $course): void
    {
        $course->update(["name" => $request->nameCourse,
            "description" => strip_tags($request->descCourse),
        ]);
    }

    public function createNewCourse(Request $request): void
    {
        $this->model->create([
            'author_id' => Auth::id(),
            'censorship_id'=> 1,
            'name' => $request->nameCourse,
            'description' => strip_tags($request->descCourse),
        ]);
    }
}
