<?php

namespace App\LMS\Assignments\Services;

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
    public function paginate(int $count, int $page): LengthAwarePaginator
    {
        return $this->model->paginate($count, '*', '', $page);
    }

    public function paginateWithWhere(int $count, int $page, int $id)
    {
        return $this->model->where('role_id', '=', $id)->paginate($count, '*', '', $page);
    }

    public function getPagesNumber(int $page, int $count): array
    {
        $maxPage = ceil(count($this->model->select('id')->get()) / $count);

        $pages = [
            'main_page' => $page
        ];

        if ($page > 1) {
            $pages['min_page'] = 1;
        }

        if ($maxPage > 1 && $maxPage != $page) {
            $pages['max_page'] = $maxPage;
        }

        if ($page - 1 > 1) {
            $pages['prev_page'] = $page - 1;
        }

        if ($page + 1 < $maxPage) {
            $pages['next_page'] = $page + 1;
        }

        return $pages;
    }
}
