<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest\ActivityRequest;
use App\LMS\Repositories\ActivitiesTestRepository;
use App\LMS\Repositories\ActivitiesTextRepository;
use App\LMS\Repositories\ActivitiesTypeRepository;
use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use App\Models\ActivitiesType;
use App\Models\Courses;
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
    public function info(ActivityRequest $request)
    {
        $makeDTO = $request->validated();
    }

    /**
     * Отображение формы добавление элемента
     */
    public function addPage(Courses $course)
    {
        return view('forms/addActivity', [
            'courseId' => $course->getKey(),
            'activitiesType' => (new ActivitiesTypeRepository(new ActivitiesType()))->all()
        ]);
    }

    /**
     * Добавление элемента
     */
    public function addActivity(Request $request, Courses $course)
    {
        $repository = $this->getRepository($request->input('type_id'));
        $repository->createActivity($request);
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
    private function getRepository(ActivityRequest $request)
    {
        $makeDTO = $request->makeDTO();
    }

}
