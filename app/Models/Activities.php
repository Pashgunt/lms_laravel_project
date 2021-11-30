<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Общая модель для активити элементов
 */
class Activities extends Model
{
    use HasFactory;

    /**
     * Поля для заполнения
     */
    protected $fillable = [
        'course_id',
        'type_id',
        'priority',
        'content_id'
    ];
}
