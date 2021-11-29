<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRequest\RegRequest;
use App\LMS\Repositories\UserRepository;
use App\Mail\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Контроллер для регистрации пользователей
 */
class RegisteredUserController extends Controller
{

    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Логика для занесения нового пользователя
     */
    public function store(RegRequest $request)
    {
        /**
         *  Проверка валидации полей
         */
        $request->validated();

        /**
         * Занесение данных в таблицу с пользователями
         * Поля, которые будут заноситьсть должны совпадать с массивом fillable в модели User
         */
        $user = $this->userRepository->updateOrCreate($request);

        /**
         * Отправляем на почту письмо с подтверджением регистрации
         */
        if ($user) {
            Mail::to($request->input('email'))->send(new UserRegistered($user));
            return view('verifyRegister', ['user' => $user]);
        }
    }

    /**
     * Метод для подтверждения почты
     */
    public function confirmEmail($email_verify_token, Request $request)
    {
        $this->userRepository->whereToken($email_verify_token, $request);

        $request->session()->flash('message', 'Регистрация завершена успешно, авторизируйтесь');

        return redirect('/login');
    }
}
