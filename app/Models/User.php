<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Общая модель для пользователей
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
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
     */
    protected $hidden = [
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Отношение курсов и автора
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Courses::class, 'author_id');
    }

    /** Проверка, назначена ли пользователю конкретная роль */
    public function hasRole(string $role): bool
    {
        $userRole = Role::find($this->role_id);
        if (strtolower($userRole->role_name) === $role) {
            return true;
        }

        return false;
    }

    /** Отправка токена письмом */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
