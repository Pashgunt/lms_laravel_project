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
     * Получение информации об элементе
     */
    public function getActivityInfo(string $contentId)
    {
        return $this->model
            ->select(['activities.id', 'activities.course_id', 'activities.content_id', 'activities.type_id', 'activities.priority', 'activities_text.title', 'activities_text.content'])
            ->where('activities.content_id', '=', $contentId)
            ->join('activities_text', 'activities_text.id', '=', 'activities.content_id')
            ->get();
    }

    /**
     * Получение коллекции элементов курса
     */
    public function getCourseActivities(Courses $course): Collection
    {
        return $this->model
            ->select(['activities.id', 'activities.course_id', 'activities.content_id', 'activities.type_id', 'activities.priority', 'activities_text.title', 'activities_text.content'])
            ->where('course_id', '=', $course->getKey())
            ->orderBy('priority', 'asc')
            ->join('activities_text', 'activities_text.id', '=', 'activities.content_id')
            ->get();
    }

    /**
     * Получение сортированной коллекции
     */
    public function getSortedList(Courses $course, string $param, string $type): Collection
    {
        return $this->model
            ->select(['activities.id', 'activities.course_id', 'activities.content_id', 'activities.type_id', 'activities.priority', 'activities_text.title', 'activities_text.content'])
            ->where('course_id', '=', $course->getKey())
            ->orderBy($param, $type)
            ->join('activities_text', 'activities_text.id', '=', 'activities.content_id')
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
     * Формирование массива на добавление элемента
     */
    public function createActivity(array $data, Courses $course, int $contentId): Activities
    {
        return $this->model->create([
            'course_id' => $course->getKey(),
            'type_id' => $data['type_id'],
            'priority' => $this->getLastPriority($course) + 1,
            'content_id' => $contentId
        ]);
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
            ->where('priority', '=', $param)
            ->update([
                'priority' => $activity->priority
            ]);

        $this->model
            ->where('id', '=', $activity->getKey())
            ->update([
                'priority' => $param
            ]);
    }

    public function getCourseId(string $type, string $contentId)
    {
        return $this->model
            ->select('course_id')
            ->where('type_id', '=', $type)
            ->where('content_id', '=', $contentId)
            ->get();
    }
}
