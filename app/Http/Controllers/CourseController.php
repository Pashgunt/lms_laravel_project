<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\User;
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
//        foreach ($coursesList as $course) {
//            var_dump($course->name);
//            var_dump($course->author->username);
//        }
        //exit;
        return view('coursesList', ['coursesList' => $coursesList]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!empty($request->nameCourse)) {
            $this->repository->create([
                'author_id' => Auth::id(),
                'censorship_id'=> 1,
                'name' => $request->nameCourse,
                'description' => $request->descCourse,
                ]);

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
