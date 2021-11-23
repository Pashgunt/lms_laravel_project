<?php

namespace App\LMS\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected User $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function all()
    {
        return $this->model->all();
    }

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
        return $this->model->paginate($count, '*', '', $page);
    }

    /** Редактирование информации о пользователе */
    public function editUserInfo(Request $request, int $userId): bool
    {
        return $this->model
            ->where('id', '=', "$userId")
            ->update(['username' => $request->input('username'), 'email' => $request->input('email'), 'date_birth' => $request->input('date_birth')]);
    }

    /** Получение информации о юзере через ID */
    public function getUserInfo(int $userId): object
    {
        return $this->model
            ->select('id', 'username', 'email', 'date_birth', 'role_id')
            ->where('id', '=', $userId)
            ->get();
    }

    /** Удаление юзера по ID */
    public function deleteUser(int $userId): bool
    {
        return DB::table('users')->delete($userId);
    }
}
