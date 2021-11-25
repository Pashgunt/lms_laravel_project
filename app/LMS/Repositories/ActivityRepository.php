<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Collection;

class ActivityRepository extends Repositories
{
    public function getCourseActivities(int $courseId): Collection
    {
        return $this->model
            ->where('course_id', '=', $courseId)
            ->orderBy('priority', 'asc')
            ->get();
    }

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
}
