<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use App\Models\Courses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * Отображает список курсов с шагом 10
     */
    public function index(): View
    {
        $coursesList = $this->repository->paginate(10);

        if ($coursesList->lastPage() < $coursesList->currentPage()) {
            return view('errors.404');
        }

        return view('coursesList', ['coursesList' => $coursesList]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!empty($request->nameCourse)) {
            $this->repository->createNewCourse($request);

            return redirect('/courses');
        }

        return view('courseEdit');
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

    public function edit(Courses $course): View
    {
        return view('courseEdit', ['course' => $course]);
    }

    public function editCourse(Request $request, Courses $course): RedirectResponse
    {
        $this->repository->editCourseInfo($request, $course);

        return redirect()->to('/courses');
    }

    /*
     * Удаляет курс
     */
    public function destroy(Courses $course): RedirectResponse
    {
        $course->delete();

        return redirect()->to('/courses');
    }
}
