<?php

namespace App\Http\Request\ValidateRequest;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Метод в которм описываются все правила валидации для необходимых полей
     * required - обязательное к заполнению
     * regex - соответствует регулярному выражению
     */
    public function rules(): array
    {
        return [
            'login' => 'required|email',
            'password' => 'required|min:6|max:30',
        ];
    }

    /**
     * Метод для перевода атрибутов ошибок с en на ru
     */
    public function attributes(): array
    {
        return [
            'login' => 'E-mail',
            'password' => 'Пароль',
        ];
    }

    /**
     * Метод для вывода всех возможных ошибок, которые появляются после прохождения по правилам валидации
     * Описанных в методе rules()
     */
    public function messages(): array
    {
        return [
            'login.required' => 'Поле обязательно к заполнению',
            'password.required' => 'Поле обязательно к заполнению',
            'login.email' => 'Проверьте введенные данные',
        ];
    }
}
