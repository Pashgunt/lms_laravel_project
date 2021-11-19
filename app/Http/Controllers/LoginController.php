<?php

namespace App\Http\Controllers;

class LoginController
{
    /** Метод отображение базовой страницы */
    public function main ()
    {
        return view('authorization');
    }
}
