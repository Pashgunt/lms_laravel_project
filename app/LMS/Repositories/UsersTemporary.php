<?php

namespace App\LMS\Repositories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class UsersTemporary extends Authenticatable
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
        'role_id',
        'email_verify_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'role_id'
    ];

    /**
     * Создание токена для пдтверждения почты
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($usersTemporary) {
            $usersTemporary->email_verify_token = Str::random(30);
        });
    }
}
