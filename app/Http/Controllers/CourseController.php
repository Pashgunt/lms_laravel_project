<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest\CourseRequest;
use App\LMS\Repositories\ActivitiesTypeRepository;
use App\LMS\Repositories\CoursesActivitiesRepository;
use App\Models\ActivitiesType;
use App\Models\Course;
use App\Models\CoursesActivitiesModel;
use Illuminate\Http\RedirectResponse;
use App\LMS\Repositories\CourseRepository;
use Illuminate\Contracts\View\View;

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
    public function store(CourseRequest $request): RedirectResponse
    {
        $DTO = $request->makeDTO();

        return redirect('/courses/' . $this->repository->createNewCourse($DTO));
    }

    /**
     * Отображает детальную страницу для курса
     */
    public function show(Course $course): View
    {
        return view('courseDetail', [
            'course' => $course,
            'activities' => (new CoursesActivitiesRepository(new CoursesActivitiesModel()))->getActivitiesList($course),
            'types' => (new ActivitiesTypeRepository(new ActivitiesType()))->all()
        ]);
    }

    /**
     * Отображает форму изменения курса
     */
    public function edit(Course $course): View
    {
        return view('courseEdit', [
            'course' => $course,
            'title' => 'LMS - редактирование курса ' . $course->name
        ]);
    }

    /**
     * Валидирует данные для изменения курса
     */
    public function editCourse(CourseRequest $request, Course $course): RedirectResponse
    {
        $courseDTO = $request->makeDTO();

        $this->repository->editCourseInfo($courseDTO, $course);

        return redirect()->to('/courses/' . $course->id . '/edit');
    }

    /**
     * Удаляет курс
     */
    public function destroy(Course $course): RedirectResponse
    {
        $appoinments = $course->appointments;
        foreach ($appoinments as $appoinment) {
            $appoinment->delete();
        }
        $course->delete();

        return redirect()->back();
    }
}
