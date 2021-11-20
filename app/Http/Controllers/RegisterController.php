<?php

namespace App\Http\Controllers;

use App\Http\Request\ValidateRequest\RegRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        /**
         * Если пользователь уже существует и он вводит свои даынные
         * То его перекидывает на его страницу
         * Заменить login, но другой Router
         */
        if (Auth::check()) {
            return redirect()->to(route('login'));
        }

        /**
         *  Проверка валидации полей
         */
        $this->validateController->checkReg($request);

        /**
         * Занесение данных в таблицу с пользователями
         * Поля, которые будут заноситьсть должны совпадать с массивом fillable в модели User
         */
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'date_birth' => $request->input('date_birth'),
            'role_id' => 1,
        ]);

        /**
         * Если пользователь успешно зарегестрировался перенаправляем на страницу авторизации
         */
        if ($user) {
            return redirect()->to(route('login'));
        }

        /**
         * Обработка ошибки, если она произшла на моменте подключения и занесения данных в БД
         */
        return redirect(route('reg'))->withErrors([
            'formError' => "Произошла ошибка при создании пользователя",
        ]);
    }
}
