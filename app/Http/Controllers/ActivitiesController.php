<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use App\Models\Courses;
use Illuminate\Http\Request;

/** Контроллер для CRUD вложенных элементов курса (Activities)  */
class ActivitiesController extends Controller
{
    protected ActivityRepository $repository;

    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    /** Отображение страницы с информацией об элементе */
    public function info (Activities $activity)
    {
        return view ('activityInfo', [
            'activity' => $activity
            ]
        );
    }

    /** Отображение формы добавление элемента */
    public function addPage (Courses $course)
    {
        return view ('forms/addActivity', [
            'courseId' => $course->id,
            'activitiesType' => ['text']
        ]);
    }

    /** Добавление элемента */
    public function addActivity (Request $request, Courses $course)
    {
        $this->repository->createActivity($request->all(), $course);

        return redirect("/courses/$course->id}");
    }

    /** Отображение формы редактирования элемента */
    public function editPage (Activities $activity)
    {
        return view('forms/editActivityInfo', [
            'activity' => $activity
        ]);
    }

    /** Редактирование элемента */
    public function editActivity (Request $request, Activities $activity)
    {
        $this->repository->editActivity($request, $activity->id);

        return redirect("/courses/activity/$activity->id/edit");
    }

    /** Удаление элемента */
    public function delete (Activities $activity)
    {
        $this->repository->delete($activity->id);

        return redirect("/courses/$activity->course_id");
    }

}
