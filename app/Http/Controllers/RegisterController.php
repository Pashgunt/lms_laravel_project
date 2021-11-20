<?php

namespace App\Http\Controllers;

use App\Http\Request\ValidateRequest\RegRequest;

class RegisterController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /** Метод отображение базовой страницы */
    public function main()
    {
        return view('registration');
    }

    /**
     * Метод для отправления данных при регситрации
     * Прохождение валидации
     */
    public function getReg(RegRequest $request)
    {
        $this->validateController->checkReg($request);
    }
}
