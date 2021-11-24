<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Courses extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'author_id',
        'censorship_id',
        'description'
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
