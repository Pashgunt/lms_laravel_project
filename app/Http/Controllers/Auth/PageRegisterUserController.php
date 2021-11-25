<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Класс для работы со страницей регистрации
 */
class PageRegisterUserController extends Controller
{
    /**
     * Отображение страницы с регистрацией пользователя
     */
    public function create(): View
    {
        return view('register');
    }
}
