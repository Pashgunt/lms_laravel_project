<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Общая модель для курсов
 */
class Courses extends Authenticatable
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
        'censorship_id',
        'description'
    ];

    /**
     * Отношение курса и автора
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
     * возвращает название курса
     */
    public function getName(): string
    {
        return $this->fillable['name'];
    }
}
