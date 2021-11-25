<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use App\Models\Courses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\LMS\Repositories\CourseRepository;
use Illuminate\Contracts\View\View;

/**
 * Класс для работы с курсами
 */
class CourseController extends Controller
{
    protected CourseRepository $repository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    /**
     * Отображение главное страницы с курсами
     */
    public function index(): View
    {
        $coursesList = $this->repository->all();
        return view('coursesList', ['coursesList' => $coursesList]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    /**
     * Отображение курса
     */
    public function show(Courses $course): View
    {
        $model = new Activities();

        return view('courseDetail', [
            'course' => $course,
            'activities' => (new ActivityRepository($model))->getCourseActivities($course->id)
        ]);
    }

    /**
     * Открытие окна редактирования курса
     */
    public function edit(int $id): View
    {
        $course = $this->repository->getById($id);
        return view('courseEdit', ['course' => $course]);
    }

    /**
     * Метод для редактирования данных о курсе
     */
    public function editCourse(CourseEditRequest $request, int $id): RedirectResponse
    {
        $request->validated();

        $this->repository->editCourseInfo($request, $id);
        return redirect()->to('/courses');
    }

    public function update(Request $request, Courses $course)
    {
    }

    /**
     * Метод для удаления курса
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->repository->delete($id);
        return redirect()->to('/courses');
    }
}
