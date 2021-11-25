<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\LMS\Assignment\Services\Paginate;
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
    public function getUsersList(int $page, int $count): LengthAwarePaginator
    {
        return (new Paginate($this->model))->paginate($count, $page);
    }

    /** Редактирование информации о пользователе */
    public function editUserInfo(Request $request, User $user): bool
    {
        return $this->model
            ->where('id', '=', "$user->id")
            ->update(['username' => $request->input('username'), 'email' => $request->input('email'), 'date_birth' => $request->input('date_birth')]);
    }

    public function searchUser($request)
    {
        return $this->model
            ->where('username', 'LIKE', '%' . $request . '%')->get();
    }

}
