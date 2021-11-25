<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Collection;

class ActivityRepository extends Repositories
{
    public function getCourseActivities(int $courseId): Collection
    {
        return $this->model->where('course_id', '=', $courseId)->get();
    }

    public function getActivitiesList ()
    {
        return $this->model->all();
    }
}
