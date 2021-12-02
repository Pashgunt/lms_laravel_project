<?php

namespace App\LMS\Repositories;

use App\LMS\Abstracts\Repositories;
use App\LMS\Assignments\Services\Paginate;
use App\Models\User;
use App\Models\UsersTemporary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * Репозиторий для работы с методами для предназначенных для пользователей
 */
class UserRepository extends Repositories
{

    /** Добавление пользователя */
    public function updateOrCreate($request)
    {
        $user = $this->model->where('email', $request->input('email'))->first();

        if ($user !== null) {
            return $user;
        } else {
            return User::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'date_birth' => $request->input('date_birth'),
                'role_id' => 1,
                'email_verify_token' => Str::random(30)
            ]);
        }
    }

    /** Получение списка пользователей через пагинацию */
    public function getUsersList(int $count)
    {
        return $this->paginate($count);
    }

    /** Получение списка пользователей через пагинацию для страницы назначений*/
    public function getSpecialUserListController(int $count)
    {
        return $this->paginateForUsers($count);
    }

    /** Редактирование информации о пользователе */
    public function editUserInfo(Request $request, User $user): bool
    {
        return $this->model
            ->where('id', '=', "$user->id")
            ->update([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'date_birth' => $request->input('date_birth'),
                'role_id' => $request->input('role_id')
            ]);
    }

    /**
     * Метод для реализации поиска по пользователям
     */
    public function searchUser($request)
    {
        return $this->model
            ->where('username', 'LIKE', '%' . $request . '%')->get();
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
        $this->model
            ->where('email_verify_token', '=', $token)
            ->update([
                'email_verified_at' => '' . getdate()['mday'] . '.' . getdate()['mon'] . '.' . getdate()['year'],
                'email_verify_token' => null,
            ]);

        return redirect('/login');
    }
}
