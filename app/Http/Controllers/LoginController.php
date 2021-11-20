<?php

namespace App\Http\Controllers;

use App\Http\Request\ValidateRequest\AuthRequest;

class LoginController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /** Метод отображение базовой страницы */
    public function main()
    {
        return view('authorization');
    }

    /**
     * Метод для отправления данных при регситрации
     * Прохождение валидации
     */
    public function getAuthorization(AuthRequest $request)
    {
        $this->validateController->checkAuth($request);
    }
}
