<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\Models\Courses;
use App\Models\Activities;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ActivityRepository extends Repositories
{
    /**  Получение коллекции элементов курса */
    public function getCourseActivities(Courses $course): Collection
    {
        return $this->model
            ->where('course_id', '=', $course->getKey())
            ->orderBy('priority', 'asc')
            ->get();
    }

    /** Получение последнего, по приоритетности, элемента курса */
    public function getLastPriority(Courses $course): ?int
    {
        $activity = $this->model
            ->where('course_id', '=', $course->getKey())
            ->orderBy('priority', 'desc')
            ->limit(1)
            ->get();

        foreach($activity as $data) {
            return $data->priority;
        }

        return null;
    }

    /** Редактирование информации вложенного элемента курса */
    public function editActivity (Request $request, int $activityId): void
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
    public function createActivity(array $data, Courses $course): Activities
    {
        return $this->model->create([
            'course_id' => $course->id,
            'text' => $data['activity_text'],
            'activity_type' => $data['activity_type'],
            'activity_title' => $data['activity_title'],
            'priority' => $this->getLastPriority($course->id)
        ]);
    }

}
