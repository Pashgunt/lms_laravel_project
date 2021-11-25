<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ActivityRepository extends Repositories
{
    /**  Получение коллекции элементов курса */
    public function getCourseActivities(int $courseId): Collection
    {
        return $this->model
            ->where('course_id', '=', $courseId)
            ->orderBy('priority', 'asc')
            ->get();
    }

    /** Получение последнего, по приоритетности, элемента курса */
    public function getLastPriority(int $courseId): ?int
    {
        $activity = $this->model
            ->where('course_id', '=', $courseId)
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


}
