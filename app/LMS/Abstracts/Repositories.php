<?php

namespace App\LMS\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
abstract class Repositories
{
    protected Model $model;

    function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Выборка из базы
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Выборка из базы определенных полей (по умолчанию выбираются все поля)
     */
    public function getAll($columns = array('*'))
    {
        return $this->model->all($columns);
    }

    /**
     * Возвращает запись по первичному ключу (по умолчанию выбираются все поля)
     */
    public function getById($id, $columns = array('*')): ?Model
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Возвращает запись по первичному ключу (по умолчанию выбираются все поля)
     */
    public function getByIdOrFail($id, $columns = array('*')): ?Model
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Возвращает количество всех записей
     */
    public function count(): int
    {
        return $this->model->count();
    }

    /**
     * Возвращает первую запись
     */
    public function first(): Model
    {
        return $this->model->first();
    }

    /**
     * Обновляет запись в базе
     */
    public function update($row, array $data): bool
    {
        return $row->update($data);
    }

}
