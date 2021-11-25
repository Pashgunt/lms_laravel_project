<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Общая модель для ролей
 */
class Role extends Model
{
    protected $table = 'roles';

    /**
     * Возвращаем наименование роли
     */
    public function getRoleName(): string
    {
        return $this->role_name;
    }
}
