<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesText extends Model
{
    use HasFactory;

    public $table = 'activities_text';

    public $timestamps = false;

    /**
     * Поля для заполнения
     */
    protected $fillable = [
        'title',
        'content'
    ];
}
