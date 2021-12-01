<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesTest extends Model
{
    use HasFactory;

    public $table = 'activities_test';

    public $timestamps = false;

    /**
     * Поля для заполнения
     */
    protected $fillable = [
        'title',
        'about',
        'questions'
    ];
}
