<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\Models\Activities;
use App\Models\Courses;
use App\Models\CoursesActivitiesModel;

class CoursesActivitiesRepository extends Repositories
{
    /**
     * Получение списка активити элементов по ID курса
     */
    public function getActivitiesList(Courses $courses)
    {
        return $this->model
            ->select(['courses_activities.priority', 'courses_activities.id', 'activities.name'])
            ->orderBy('courses_activities.priority', 'asc')
            ->where('courses_activities.course_id', '=', $courses->getKey())
            ->join('activities', 'activities.id', '=', 'courses_activities.activity_id')
            ->get();
    }

    /**
     * Метод получения отсортированного списка активити
     */
    public function getSortedList(Courses $course, string $column, string $sort_type)
    {
        return $this->model
            ->select(['courses_activities.priority', 'courses_activities.id', 'activities.name'])
            ->orderBy('courses_activities.' . $column, $sort_type)
            ->where('courses_activities.course_id', '=', $course->getKey())
            ->join('activities', 'activities.id', '=', 'courses_activities.activity_id')
            ->get();
    }

    /**
     * Метод получения ID курса по ID активити
     */
    public function getCourseId(Activities $activity)
    {
        return $this->model
            ->select('course_id')
            ->where('activity_id', '=', $activity->getKey())
            ->get();
    }

    /**
     * Смена приоритетности вложенных элементов курса
     */
    public function changePriority(CoursesActivitiesModel $activity, string $eventType): void
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
}
