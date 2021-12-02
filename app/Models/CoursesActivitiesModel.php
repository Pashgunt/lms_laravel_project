<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesActivitiesModel extends Model
{
    use HasFactory;

    public $table = 'courses_activities';
    /**
     * Поля для заполнения
     */
    protected $fillable = [
        'courses_id',
        'activity_id',
        'priority'
    ];

}
