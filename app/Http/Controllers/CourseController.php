<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest\CourseEditRequest;
use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use App\Models\Courses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\LMS\Repositories\CourseRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

/*
 * Контроллер, реализующий CRUD-операции для курсов
 */

class CourseController extends Controller
{
    protected CourseRepository $repository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    /**
     * Отображает список курсов
     */
    public function index(): View
    {
        $coursesList = $this->repository->paginate(config('pagination.course'));

        if ($coursesList->lastPage() < $coursesList->currentPage()) {
            return view('errors.404');
        }

        return view('coursesList', ['coursesList' => $coursesList]);
    }

    /**
     * Отображает форму создания курса
     */
    public function create(): View
    {
        return view('courseEdit', ['title' => 'LMS - создание нового курса']);
    }

    /**
     * Сохраняет провалидированные данные в базу после метода create
     */
    public function store(CourseEditRequest $request): RedirectResponse
    {
        $request->validated();

        return redirect('/courses/' . $this->repository->createNewCourse($request));
    }

    /**
     * Отображает детальную страницу для курса
     */
    public function show(Courses $course): View
    {
        return view('courseDetail', [
            'course' => $course,
            'activities' => (new ActivityRepository(new Activities()))->getCourseActivities($course),
        ]);
    }

    /**
     * Отображает форму изменения курса
     */
    public function edit(Courses $course): View
    {
        return view('courseEdit', [
            'course' => $course,
            'title' => 'LMS - редактирование курса ' . $course->name
        ]);
    }

    /**
     * Валидирует данные для изменения курса
     */
    public function editCourse(CourseEditRequest $request, Courses $course): RedirectResponse
    {
        $request->validated();

        $this->repository->editCourseInfo($request, $course);

        return redirect()->to('/courses/' . $course->id);
    }

    /**
     * Удаляет курс
     */
    public function destroy(Courses $course): RedirectResponse
    {
        $course->delete();

        return redirect()->to('/courses');
    }
}
