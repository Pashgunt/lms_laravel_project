<?php

namespace App\Http\Request;

use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Request\ValidateRequest\RegRequest;
use App\Http\Request\ValidateRequest\AuthRequest;
use App\Http\Request\ValidateRequest\RecoveryRequest;

class ValidateController
{
    protected array $config;

    use ValidatesRequests;

    public function __construct()
    {
        $this->config = require '../config/check-posts.php';
    }

    /** Метод проверки комплектности $_POST */
    public function checkPosts(string $form): bool
    {
        foreach ($this->config[$form] as $value) {
            if (!isset($_POST[$value])) {
                return false;
            }
        }

        return true;
    }

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
    public function checkAuth(AuthRequest $request)
    {
    }

    /**
     * Метод для использования валидации на полях формы регистрации
     */
    public function checkRecovery(RecoveryRequest $request)
    {
    }
}
