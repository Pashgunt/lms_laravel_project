<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\LMS\Assignments\Services\Paginate;
use App\Models\User;
use App\Models\UsersTemporary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Репозиторий для работы с методами для предназначенных для пользователей
 */
class UserRepository extends Repositories
{

    /** Добавление пользователя */
    public function updateOrCreate($request)
    {
        $user = UsersTemporary::where('email', $request->input('email'))->first();

        if ($user !== null) {
            return $user;
        } else {
            return UsersTemporary::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'date_birth' => $request->input('date_birth'),
                'role_id' => 1,
            ]);
        }
    }

    /** Получение списка пользователей через пагинацию */
    public function getUsersList(int $count)
    {
        return $this->paginate($count);
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
     * @return mixed
     */
    public function searchUser(string $request, int $id = 1)
    {
        return $this->model
            ->where('username', 'LIKE', '%' . $request . '%')->where('role_id', '=', $id)->get();
    }

    /** Генерация номеров страниц */
    public function generatePagesNumber(int $page, int $count)
    {
        return (new Paginate($this->model))->getPagesNumber($page, $count);
    }

    /**
     * Проверка на токен пользователя
     */
    public function whereToken($token)
    {
        $user = UsersTemporary::query()->where('email_verify_token', '=', $token)->first();

        if ($user !== null) {
            User::create([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
                'date_birth' => $user['date_birth'],
                'role_id' => 1,
                'email_verified_at' => '' . getdate()['mday'] . '.' . getdate()['mon'] . '.' . getdate()['year'],
            ]);
            UsersTemporary::query()->where('email_verify_token', '=', $token)->delete();
        }

        return redirect('/login');
    }
}
