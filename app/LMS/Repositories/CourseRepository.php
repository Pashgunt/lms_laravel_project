<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\LMS\DTO\CourseDTO;
use App\Models\Course;
use Illuminate\Http\Request;
use App\LMS\Assignments\Services\Paginate;
use Illuminate\Support\Facades\Auth;

/**
 * Репозиторий для работы с методами для предназначенных для курсов
 */
class CourseRepository extends Repositories
{
    /**
     * Метод редактирования данных курса
     */
    public function editCourseInfo(CourseDTO $courseDTO, Course $course): void
    {
        $course->update(["name" => $courseDTO->getName(),
            "description" => $courseDTO->getDescription(),
        ]);
    }

    /**
     * Метод для создания новго курса
     */
    public function createNewCourse(CourseDTO $courseDTO): int
    {
        $course = $this->model->create([
            'author_id' => Auth::id(),
            'name' => $courseDTO->getName(),
            'description' => $courseDTO->getDescription(),
        ]);

        return $course->id;
    }

    /**
     * Метод для реализации поиска по курсам
     */
    public function searchCourse($request)
    {
        return $this->model
            ->where('name', 'LIKE', '%' . $request . '%')->get();
    }

    /** Получение списка курсов через пагинацию для страницы назначений*/
    public function getCourseList(int $count)
    {
        return $this->paginateForCourse($count);
    }
}
