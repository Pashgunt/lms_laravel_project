<?php

namespace App\LMS\Assignment\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Paginate
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /** Пагинация.
     * Count - кол-во выводимых элементов на страницу
     * Page - номер страницы
     */
    public function paginate (int $count, int $page): LengthAwarePaginator
    {
        return $this->model->paginate($count, '*', '', $page);
    }
}
