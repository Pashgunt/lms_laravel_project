<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\User;
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
    public function create(): View
    {
        return view('courseEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
        return view('courseDetail', ['course' => $course]);
    }

    public function edit(int $id): View
    {
        $course = $this->repository->getById($id);
        return view('courseEdit', ['course' => $course]);
    }

    public function editCourse(Request $request)
    {
        return redirect()->to('/courses');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Courses $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return redirect()->to('/courses');
    }
}
