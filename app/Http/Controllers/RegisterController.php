<?php

namespace App\Http\Controllers;

class RegisterController extends Controller
{
    /** Метод отображение базовой страницы */
    public function main()
    {
        return view('registration');
    }

    public function getRegistration()
    {
    }
}
