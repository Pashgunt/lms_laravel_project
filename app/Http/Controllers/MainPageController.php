<?php

namespace App\Http\Controllers;

class MainPageController
{
    /** Метод отображение базовой страницы   */
    public function main ()
    {
        return view('layout');
    }
}
