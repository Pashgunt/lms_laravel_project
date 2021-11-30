<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\Models\Activities;
use Illuminate\Http\Request;

class ActivitiesTextRepository extends Repositories
{
    /**
     * Редактирование информации вложенного элемента курса
     */
    public function editActivity(Request $request, Activities $activity): void
    {
        $this->model
            ->where('id', '=', $activity->content_id)
            ->update([
                'content' => $request->input('content'),
                'title' => $request->input('title')
            ]);
    }

    public function getLastId()
    {
        return $this->model
            ->select('id')
            ->orderBy('id','desc')
            ->limit(1)
            ->get();
    }

    public function getActivityInfo (string $id)
    {
        return $this->model->where('id', '=', "$id")->get();
    }
}
