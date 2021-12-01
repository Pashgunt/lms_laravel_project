<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\Models\Activities;
use Illuminate\Http\Request;

/**
 * Репозиторий для вложенных элементов курса типа - Текст
 */
class ActivitiesTextRepository extends Repositories
{
    /**
     * Добавление элемента
     */
    public function createActivity(Request $request){
        $this->create([
            [
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]
        ]);
    }

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

    /**
     * Получение id последнего элемента
     */
    public function getLastId()
    {
        return $this->model
            ->select('id')
            ->orderBy('id','desc')
            ->limit(1)
            ->get();
    }

    /**
     * Получение информации по id элемента
     */
    public function getActivityInfo (string $id)
    {
        return $this->model->where('id', '=', "$id")->get();
    }
}
