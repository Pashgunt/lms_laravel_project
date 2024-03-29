<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Общая модель для курсов
 */
class Course extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * Поля для заполнения
     */
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'author_id',
        'description'
    ];

    /**
     * "У курса 1 автор"
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * "У курса может быть много назначений"
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'course_id');
    }

    /**
     * "У курса много активити"
     */
    public function activities(): HasMany
    {
        return $this->hasMany(CoursesActivitiesModel::class, 'course_id');
    }
}
