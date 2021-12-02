<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
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
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'date_birth',
        'role_id',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * У автора может быть много курсов
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'author_id');
    }

    /**
     * У пользователя одна роль
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    /**
     * Отправка письма с токеном для восстановления пароля
     *
     * Использование кастомного восстановление пароля
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * У студента может быть много назначений
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'user_id', 'id');
    }
}
