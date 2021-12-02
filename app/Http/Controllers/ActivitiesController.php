<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\ActivitiesTypeRepository;
use App\LMS\Repositories\ActivityRepository;
use App\LMS\Repositories\CoursesActivitiesRepository;
use App\Models\Activities;
use App\Models\ActivitiesType;
use App\Models\Courses;
use App\Models\CoursesActivitiesModel;
use Illuminate\Http\Request;

/** Контроллер для CRUD операции по вложенным элементам курса (Activities)  */
class ActivitiesController extends Controller
{
    protected ActivityRepository $repository;

    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Отображение страницы с информацией об элементе
     */
    public function info(Activities $activities)
    {
        $courseInfo = (new CoursesActivitiesRepository(new CoursesActivitiesModel()))
            ->getCourseId($activities);

        foreach ($courseInfo as $course) {
            $courseId = $course->course_id;
        }

        return view('activityInfo', [
                                      'activities' => $activities,
                                      'data' => unserialize(json_decode($activities->additional)),
                                      'courseId' => $courseId
                                  ]
        );
    }

    /**
     * Отображение формы добавление элемента
     */
    public function addPage(Courses $course, Request $request)
    {
        $type = $request->input('activity_type');
        switch ($type) {
            case 1:
                $formName = 'addTextActivity';
                break;
            case 2:
                $formName = 'addTestActivity';
                break;
            case 3:
                $formName = 'addVideoActivity';
                break;
            case 4:
                $formName = 'addImageActivity';
                break;
        }

        return view('forms/addActivity', [
            'courseId' => $course->getKey(),
            'activityType' => $type,
            'addForm' => "forms/activities/$formName"
        ]);
    }

    /**
     * Добавление элемента
     */
    public function addActivity(Request $request, Courses $course)
    {
        $type = $request->input('activity_type');
        switch ($type) {
            case 1:
                $this->repository->create([
                                 'name' => $request->input('title'),
                                 'activity_type_id' => $request->input('content'),
                                 'additional' => json_encode(
                                     serialize([
                                                   'content' => $request->input('content')
                                               ])
                                 )
                             ]);
                (new CoursesActivitiesRepository(new CoursesActivitiesModel()))
                    ->create([
                        'course_id' => $course->getKey(),
                        'activity_id' => $this->repository->getLastId(),
                        'priority' => (new CoursesActivitiesRepository(new CoursesActivitiesModel()))
                            ->getLastPriority($course->getKey())
                             ]);
                break;
        }

        return redirect("/courses/$course->id");
    }

    /**
     * Отображение формы редактирования элемента
     */
    public function editPage(string $contentId)
    {
        return view('forms/editActivityInfo', [
            'activities' => $this->repository->getActivityInfo($contentId)
        ]);
    }

    /**
     * Редактирование элемента
     */
    public function editActivity(Request $request, Activities $activity)
    {
        $this->getRepository($activity->type_id)->editActivity($request, $activity);

        return $this->editPage($activity->content_id);
    }

    /**
     * Удаление элемента
     */
    public function delete(Activities $activities)
    {
        $this->getRepository($activities->type_id)->delete($activities->content_id);

        return redirect("/courses/$activities->course_id");
    }

    /**
     * Сортировка списка по столбцу (param(столбец)) и типу (type(asc/desc))
     */
    public function getSortedList(Courses $course, string $column, string $sort_type)
    {
        $sortTypes = ['asc', 'desc'];

        if (!in_array($sort_type, $sortTypes) && $column !== 'priority') {
            return redirect("/courses/$course->id");
        }

        return view('courseDetail', [
            'course' => $course,
            'activities' => (new CoursesActivitiesRepository(new CoursesActivitiesModel()))->getSortedList(
                $course,
                $column,
                $sort_type
            )
        ]);
    }

    /**
     * Смена приоритетности вложенных элементов курса
     */
    public function changePriority(CoursesActivitiesModel $activity, string $eventType)
    {
        (new CoursesActivitiesRepository(new CoursesActivitiesModel()))
            ->changePriority($activity, $eventType);

        return redirect("/courses/$activity->course_id");
    }
}
