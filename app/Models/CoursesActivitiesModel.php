<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CoursesActivitiesModel extends Model
{
    use HasFactory;

    public $table = 'courses_activities';
    /**
     * Поля для заполнения
     */
    protected $fillable = [
        'course_id',
        'activity_id',
        'priority'
    ];

    /*
     * "1 курс для курс-активити"
     */
    public function course(): HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    /*
     * "1 активити на курс-активити"
     */
    public function item(): HasOne
    {
        return $this->hasOne(Activities::class, 'id', 'activity_id');
    }

}
