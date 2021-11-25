<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use Illuminate\Http\Request;

/**
 * Репозиторий для работы с методами для предназначенных для курсов
 */
class CourseRepository extends Repositories
{
    /**
     * Метод редактирования данных курса
     */
    public function editCourseInfo(Request $request, int $id)
    {
        $this->model->where('id', '=', "$id")->update(["name" => $request->input('nameCourse'),
            "description" => strip_tags($request->input('descCourse')),
        ]);
    }
}
