<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Общая модель для активити элементов
 */
class Activities extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * Поля для заполнения
     */
    protected $fillable = [
        'course_id',
        'text',
        'activity_type',
        'activity_title',
        'link',
        'priority'
    ];
}
