<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\ValidateController;

class RegisterController extends Controller
{

    public ValidateController $validateController;

    function __construct()
    {
        parent::__construct();
    }

    /** Метод отображение базовой страницы */
    public function main()
    {
        return view('registration');
    }

    public function getReg(Request $request)
    {
        $this->validateController->checkPass($request);
        $this->validateController->checkEmail($request);
        $this->validateController->checkUsername($request);
        return view('layout');
    }
}
