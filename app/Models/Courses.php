<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Общая модель для курсов
 */
class Courses extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Поля для заполнения
     */
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'author_id',
        'censorship',
        'description'
    ];
}
