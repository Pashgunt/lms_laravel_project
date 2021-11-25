<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use Illuminate\Http\Request;
use App\LMS\Assignment\Services\Paginate;

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

    /**
     * Метод для реализации поиска по курсам
     */
    public function searchCourse($request)
    {
        return $this->model
            ->where('name', 'LIKE', '%' . $request . '%')->get();
    }


}
