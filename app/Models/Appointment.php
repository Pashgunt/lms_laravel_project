<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
    ];

    /*
     * "У назначения 1 курс"
     */
    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    /*
     * "У назначения 1 студент"
     */
    public function student()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
