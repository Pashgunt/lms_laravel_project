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
     * Получение ID последнего элемента
     */
    public function getLastId(): int
    {
        $elem = $this->model
            ->select('id')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        return $elem[0]->id;
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
}
