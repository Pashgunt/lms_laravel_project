<?php

namespace App\Http\Requests;

use App\Http\Requests\ValidateRequest\EditUserRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\ValidateRequest\RegRequest;
use App\Http\Requests\ValidateRequest\RecoveryRequest;

class ValidateController
{
    protected array $config;

    use ValidatesRequests;

    /**
     * Метод для использования валидации на полях формы регистрации
     * Все классы для валидаций находятся в папке ValidateRequest
     * Подробнее в документацию на валидацию
     */
    public function checkReg(RegRequest $request)
    {
    }

    /**
     * Метод для использования валидации на полях формы регистрации
     */
    public function checkRecovery(RecoveryRequest $request)
    {
    }

    /** Метод валидации отредактированных данных юзера */
    public function checkEditUser(EditUserRequest $request) {}
}
