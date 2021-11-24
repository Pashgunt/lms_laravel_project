<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRequest\RegRequest;
use App\LMS\Repositories\UserRepository;

class RegisteredUserController extends Controller
{

    public UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        return view('register');
    }

    public function store(RegRequest $request)
    {

        $this->userRepository = new UserRepository();

        /**
         *  Проверка валидации полей
         */
        $this->validateController->checkReg($request);

        /**
         * Занесение данных в таблицу с пользователями
         * Поля, которые будут заноситьсть должны совпадать с массивом fillable в модели User
         */
        $user = $this->userRepository->insertNewUser($request);

        /**
         * Если пользователь успешно зарегестрировался перенаправляем на страницу авторизации
         */
        if ($user) {
            $request->session()->flash('message', 'Регистрация завершена успешно');
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
