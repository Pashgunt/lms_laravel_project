<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\ActivityRepository;
use App\Models\Activities;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    protected ActivityRepository $repository;

    public function __construct(ActivityRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function info (Activities $activity)
    {
        return view ('activityInfo', [
            'activity' => $activity
            ]
        );
    }

    public function addPage (int $courseId)
    {
        return view ('forms/addActivity', [
            'courseId' => $courseId,
            'activitiesList' => ''
        ]);
    }

}
