<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Общая модель для ролей
 */
class Role extends Model
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_USER = 'user';

    protected $table = 'roles';
}
