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

    public const ACTIVITY_TEXT = 1;
    public const ACTIVITY_TEST = 2;
    public const ACTIVITY_VIDEO = 3;
    public const ACTIVITY_IMAGE = 4;

    /**
     * Поля для заполнения
     */
    protected $fillable = [
        'name',
        'activity_type_id',
        'additional',
    ];
}

