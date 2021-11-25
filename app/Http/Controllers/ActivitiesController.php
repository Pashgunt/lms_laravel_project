<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\ActivitiesTypeRepository;
use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use App\Models\Courses;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    protected ActivityRepository $repository;
    protected ActivitiesTypeRepository $types;

    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function info (Activities $activity)
    {
        return view ('activityInfo', [
            'activity' => $activity
            ]
        );
    }

    public function addPage (Courses $course)
    {
        return view ('forms/addActivity', [
            'courseId' => $course->id,
            'activitiesType' => ['text']
        ]);
    }

    public function addActivity (Request $request, Courses $course)
    {
        $priority = $this->repository->getLastPriority($course->id) + 1;

        $this->repository->create([
            'course_id' => $course->id,
            'text' => $request->input('activity_text'),
            'activity_type' => $request->input('activity_type'),
            'activity_title' => $request->input('activity_title'),
            'priority' => $priority
        ]);

        return redirect("/courses/$course->id}");
    }

    public function delete (Activities $activity)
    {
        $this->repository->delete($activity->id);

        return redirect("/courses/$activity->course_id");
    }

}
