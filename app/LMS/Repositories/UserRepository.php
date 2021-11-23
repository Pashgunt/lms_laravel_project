<?php

namespace App\LMS\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /** Добавление пользователя */
    public function insertNewUser($user, $request): bool
    {
        return $user::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'date_birth' => $request->input('date_birth'),
            'role_id' => 1,
        ]);
    }

    /** Получение списка пользователей через пагинацию */
    public function getUsersList(int $page, int $count): ?object
    {
        return DB::table('users')->paginate($count, '*', '', $page);
    }

    /** Редактирование информации о пользователе */
    public function editUserInfo(Request $request, int $userId): bool
    {
        return DB::table('users')
            ->where('id', '=', "$userId")
            ->update(['username' => $request->input('username'), 'email' => $request->input('email'), 'date_birth' => $request->input('date_birth')]);
    }

    /** Получение информации о юзере через ID */
    public function getUserInfo(int $userId): object
    {
        return DB::table('users')
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
