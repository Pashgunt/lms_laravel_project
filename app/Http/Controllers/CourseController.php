<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use App\Models\Courses;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\LMS\Repositories\CourseRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    protected CourseRepository $repository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $coursesList = $this->repository->all();

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Courses $course
     * @return \Illuminate\Http\Response
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


    public function update(Request $request, Courses $course)
    {
        //
    }


    public function destroy(Courses $course): RedirectResponse
    {
        $course->delete();

        return redirect()->to('/courses');
    }
}
