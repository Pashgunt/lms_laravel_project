<?php

namespace App\Http\Controllers;

use App\Http\Request\ValidateRequest\RecoveryRequest;

class RecoveryController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /** Метод отображение базовой страницы */
    public function main()
    {
        return view('recovery');
    }

    /**
     * Метод для отправления данных при восстановлении пароля
     * Прохождение валидации
     */
    public function getRecovery(RecoveryRequest $request)
    {
        $this->validateController->checkRecovery($request);
    }
}
