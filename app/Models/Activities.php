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
        'name',
        'activity_type_id',
        'additional',
    ];
}

