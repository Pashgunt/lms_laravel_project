<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\LMS\Assignments\Services\Paginate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

/**
 * Репозиторий для работы с методами для предназначенных для пользователей
 */
class UserRepository extends Repositories
{

    /** Добавление пользователя */
    public function insertNewUser($request): User
    {
        return User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'date_birth' => $request->input('date_birth'),
            'role_id' => 1,
        ]);
    }

    /** Получение списка пользователей через пагинацию */
    public function getUsersList(int $count, int $page): LengthAwarePaginator
    {
        return (new Paginate($this->model))->paginate($count, $page);
    }

    public function getUserListWithConditional(int $page, int $count, int $id)
    {
        return (new Paginate($this->model))->paginateWithWhere($count, $page, $id);
    }

    /** Редактирование информации о пользователе */
    public function editUserInfo(Request $request, User $user): bool
    {
        return $this->model
            ->where('id', '=', "$user->id")
            ->update(['username' => $request->input('username'), 'email' => $request->input('email'), 'date_birth' => $request->input('date_birth')]);
    }

    /**
     * Метод для реализации поиска по пользователям
     */
    public function searchUser($request, $id)
    {
        return $this->model
            ->where('username', 'LIKE', '%' . $request . '%')->where('role_id', '=', $id)->get();
    }

    /** Генерация номеров страниц */
    public function generatePagesNumber(int $page, int $count)
    {
        return (new Paginate($this->model))->getPagesNumber($page, $count);
    }
}