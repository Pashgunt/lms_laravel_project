<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\Models\Courses;
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
    public function editCourseInfo($request, Courses $course): void
    {
        $course->update(["name" => $request->nameCourse,
            "description" => strip_tags($request->descCourse),
        ]);
    }

    public function createNewCourse(Request $request): int
    {
        $course = $this->model->create([
            'author_id' => Auth::id(),
            'censorship_id' => 1,
            'name' => $request->nameCourse,
            'description' => strip_tags($request->descCourse),
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

    public function getCourseList(int $page, int $count)
    {
        return (new Paginate($this->model))->paginate($count, $page);
    }

    public function generatePageNumbersForUsers(int $page, int $count)
    {
        return (new Paginate($this->model))->getPagesNumber($page, $count);
    }
}
