<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\LMS\Repositories\CourseRepository;
use Illuminate\Contracts\View\View;

class CourseController extends Controller
{
    protected CourseRepository $repository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    public function index(): View
    {
        $coursesList = $this->repository->all();
        return view('coursesList', ['coursesList' => $coursesList]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Courses $course)
    {
        return view('courseDetail', ['course' => $course]);
    }

    public function edit(int $id)
    {
        $course = $this->repository->getById($id);
        return view('courseEdit', ['course' => $course]);
    }

    public function editCourse(Request $request, int $id)
    {
        $this->repository->editCourseInfo($request, $id);
        return redirect()->to('/courses');
    }


    public function update(Request $request, Courses $course)
    {
        //
    }


    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return redirect()->to('/courses');
    }
}
