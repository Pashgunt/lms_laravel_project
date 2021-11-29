<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\Models\Courses;
use App\Models\Activities;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

/**
 * Репозиторий для работы с вложенными элементами курса
 */
class ActivityRepository extends Repositories
{
    /**
     * Получение коллекции элементов курса
     */
    public function getCourseActivities(Courses $course): Collection
    {
        return $this->model
            ->where('course_id', '=', $course->getKey())
            ->orderBy('priority', 'asc')
            ->get();
    }

    /**
     * Получение последнего, по приоритетности, элемента курса
     */
    public function getLastPriority(Courses $course): ?int
    {
        $activity = $this->model
            ->where('course_id', '=', $course->getKey())
            ->orderBy('priority', 'desc')
            ->limit(1)
            ->get();

        foreach ($activity as $data) {
            return $data->priority;
        }

        return null;
    }

    /**
     * Редактирование информации вложенного элемента курса
     */
    public function editActivity(Request $request, int $activityId): void
    {
        $this->model
            ->where('id', '=', $activityId)
            ->update([
                'text' => $request->input('activity_text'),
                'activity_title' => $request->input('activity_title'),
                'link' => $request->input('activity_link')
            ]);
    }

    /**
     * Формирование массива на добавление элемента
     */
    public function createActivity(array $data, Courses $course): ?Activities
    {
        if (isset($data['activity_text']) && isset($data['activity_type']) && isset($data['activity_title'])) {
            return $this->model->create([
                'course_id' => $course->getKey(),
                'text' => $data['activity_text'],
                'activity_type_id' => $data['activity_type'],
                'activity_title' => $data['activity_title'],
                'priority' => $this->getLastPriority($course) + 1
            ]);
        }

        return null;

    }

    /**
     * Получение сортированной коллекции
     */
    public function getSortedList(Courses $course, string $param, string $type): Collection
    {
        return $this->model
            ->where('course_id', '=', $course->getKey())
            ->orderBy($param, $type)
            ->get();
    }

    /**
     * Получение списка наименований столбцов
     */
    public function getColumnNames()
    {
        return Schema::getColumnListing('activities');
    }

    /**
     * Смена приоритетности вложенных элементов курса
     */
    public function changePriority(Activities $activity, string $eventType): void
    {
        switch ($eventType) {
            case 'up':
                $param = $activity->priority - 1;
                break;
            case 'down':
                $param = $activity->priority + 1;
                break;
        }

        $this->model
            ->where('priority','=',$param)
            ->update([
                'priority' => $activity->priority
            ]);
        $this->model
            ->where('id','=',$activity->getKey())
            ->update([
                'priority' => $param
            ]);
    }
}
