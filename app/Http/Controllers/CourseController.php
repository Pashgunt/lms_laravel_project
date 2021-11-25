<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\LMS\Repositories\CourseRepository;
use Illuminate\Contracts\View\View;

class CourseController extends Controller
{
    protected CourseRepository $repository;

    public function __construct(CourseRepository $courseRepository)
    {
        parent::__construct();
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Courses  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Courses $course)
    {
        $model = new Activities();

        return view('courseDetail', [
            'course' => $course,
            'activities' => (new ActivityRepository($model))->getCourseActivities($course->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courses  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Courses $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courses  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courses  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $course)
    {
        //
    }
}
