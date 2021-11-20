<?php

namespace App\Http\Request\ValidateRequest;

use Illuminate\Foundation\Http\FormRequest;

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
     */
    public function rules(): array
    {
        return [
            'email' => 'required|regex:/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$ /',
            'username' => 'required|regex:/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$ /',
            'password' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/',
            'rePassword' => 'required|same:password|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/',
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
            'username.required' => 'Поле обязательно к заполнению',
            'password.required' => 'Поле обязательно к заполнению',
            'rePassword.required' => 'Поле обязательно к заполнению',
            'email.regex' => 'Проверьте введенные данные',
            'username.regex' => 'Проверьте введенные данные',
            'password.regex' => 'Проверьте введенные данные',
            'rePassword.regex' => 'Проверьте введенные данные',
            'rePassword.same' => 'Поле должно совадать с Паролем',
        ];
    }
}
