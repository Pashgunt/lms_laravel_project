<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

/**
 * Класс для отображения глваной страницы сайта
 */
class MainPageController
{
    /** Метод отображение базовой страницы  */
    public function main(): View
    {
        return view('layout');
    }
}
