<?php

namespace App\Http\Requests\ValidateRequest;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Метод в которм описываются все правила валидации для необходимых полей
     * required - обязательное к заполнению
     * regex - соответствует регулярному выражению
     * same - с каком полем должно совпадать
     * email - соотвтетсвует формату email
     * unique - уникальность, в качестве параметров указывается имя таблицы в БД
     * date - соотвтетсвует формату date
     */
    public function rules(): array
    {

        $date = Carbon::now()->subYears(5);

        return [
            'email' => 'required|
                        email|
                        unique:users',
            'username' => 'required|
                           string|
                           min:10',
            'password' => Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(),
            'rePassword' => 'required|
                             same:password',
            'date_birth' => 'required|
                             date|
                             before_or_equal:' . $date
        ];
    }

    /**
     * Метод для перевода атрибутов ошибок с en на ru
     */
    public function attributes(): array
    {
        return [
            'email' => 'E-mail',
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'rePassword' => 'Пароль'
        ];
    }

    /**
     * Метод для вывода всех возможных ошибок, которые появляются после прохождения по правилам валидации
     * Описанных в методе rules()
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Поле обязательно к заполнению',
            'email.email' => 'Проверьте введенные данные',
            'email.unique' => 'Пользователь с таким Email же зарегестрирован',
            'username.required' => 'Поле обязательно к заполнению',
            'username.min' => 'Поле должно быть не менее 10 символов',
            'username.string' => 'Поле должно состоять из стрококвых символов',
            'password.min' => 'Минимум 8 символов',
            'password.letters' => 'Пароль должен содержать буквы',
            'password.mixedCase' => 'Пароль должен содержать буквы верхнего и нижнего регистра',
            'password.numbers' => 'Пароль должен содержать цифры',
            'password.symbol' => 'Пароль должен содержать символы',
            'rePassword.required' => 'Поле обязательно к заполнению',
            'rePassword.same' => 'Поле должно совадать с Паролем',
            'date_birth.required' => 'Поле обязательно к заполнению',
            'date_birth.date' => 'Введенные данные должны соответствовать типу даты',
            'date_birth.before_or_equal' => 'Вам должно быть больше 18 лет',
        ];
    }
}
