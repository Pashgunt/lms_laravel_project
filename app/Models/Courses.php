<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Courses extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'created_at',
        'deleted_at',
        'updated_at',
        'author',
        'censorship',
        'description'
    ];
}
