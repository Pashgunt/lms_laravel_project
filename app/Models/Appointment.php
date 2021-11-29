<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'appointments';

    protected $fillable = [
        'course_id',
        'user_id',
        'created_at',
        'updated_at',
        'author_id',
    ];

    /*
     * Отношение курсов к назначениям
     */
    public function course(): HasMany
    {
        return $this->hasMany(Courses::class, 'id', 'course_id');
    }

    /*
     * Отношение студентов к назначениям
     */
    public function student(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
