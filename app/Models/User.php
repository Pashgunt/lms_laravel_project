<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'date_birth',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** Получение списка пользователей через пагинацию */
    public function getUsersList(int $page, int $count): ?object
    {
        return DB::table('users')->paginate($count, '*', '', $page);
    }

    /** Редактирование информации о пользователе */
    public function editUserInfo(Request $request, int $userId): bool
    {
        var_dump('Up!');
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
