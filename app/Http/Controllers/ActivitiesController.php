<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest\ActivityAddRequest;
use App\LMS\Repositories\ActivitiesTextRepository;
use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use App\Models\ActivitiesText;
use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/** Контроллер для CRUD вложенных элементов курса (Activities)  */
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
    public function info(string $activityType, string $contentId)
    {
        return view('activityInfo', [
                'activities' => $this
                    ->getRepository($activityType)
                    ->getActivityInfo($contentId),
                'courseId' => $this->repository->getCourseId($activityType, $contentId),
                'activityTypeId' => $activityType
            ]
        );
    }

    /**
     * Отображение формы добавление элемента
     */
    public function addPage(Courses $course)
    {
        return view('forms/addActivity', [
            'courseId' => $course->getKey(),
            'activitiesType' => [
                'Текст' => 1
            ]
        ]);
    }

    /**
     * Добавление элемента
     */
    public function addActivity(Request $request, Courses $course)
    {
        $repository = $this->getRepository($request->input('type_id'));
        $repository->create([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        $contentId = $repository->getLastId();

        $this->repository->createActivity($request->all(), $course, $contentId[0]['id']);

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
    public function delete(string $type, string $contentId)
    {
        $this->getRepository((int)$type)->delete((int)$contentId);
        $collections = $this->repository->getCourseId($type, $contentId);
        foreach ($collections as $item) {
            $id = $item->course_id;
        }

        return redirect("/courses/$id");
    }

    /**
     * Сортировка списка по столбцу (param(столбец)) и типу (type(asc/desc))
     */
    public function getSortedList(Courses $course, string $column, string $sort_type)
    {
        $sortTypes = ['asc', 'desc'];
        if (!in_array($sort_type, $sortTypes)) {
            return redirect("/courses/$course->id");
        }
        $columns = $this->repository->getColumnNames();
        if (!in_array($column, $columns)) {
            return redirect("/courses/$course->id");
        }

        return view('courseDetail', [
            'course' => $course,
            'activities' => $this->repository->getSortedList($course, $column, $sort_type)
        ]);
    }

    /**
     * Смена приоритетности вложенных элементов курса
     */
    public function changePriority(Activities $activity, string $eventType)
    {
        $this->repository->changePriority($activity, $eventType);

        return redirect("/courses/$activity->course_id");
    }

    /**
     * Получение нужного репозитория по type_id
     */
    private function getRepository(int $type_id)
    {
        switch ($type_id) {
            case 1:
                return new ActivitiesTextRepository(new ActivitiesText());
        }
    }

}
