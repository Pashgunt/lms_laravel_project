<?php

namespace App\Http\Controllers;

class RegisterController
{
    /** Метод отображение базовой страницы */
    public function main ()
    {
        return view('registration');
    }
}
