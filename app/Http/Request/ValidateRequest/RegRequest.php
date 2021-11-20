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
     * email - соотвтетсвует формату email
     * unique - уникальность, в качестве параметров указывается имя таблицы в БД
     * date - соотвтетсвует формату date
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users|regex:/[a-z0-9]{4,}/i',
            'password' => 'required|min:6|max:30',
            'rePassword' => 'required|same:password',
            'date_birth' => 'required|date'
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
            'username.unique' => 'Пользователь с таким Именем же зарегестрирован',
            'username.regex' => 'Проверьте введенные вами данные',
            'password.required' => 'Поле обязательно к заполнению',
            'rePassword.required' => 'Поле обязательно к заполнению',
            'date_birth.required' => 'Поле обязательно к заполнению',
            'date_birth.date' => 'Проверьте введенные вами данные',
            'email.email' => 'Проверьте введенные данные',
            'email.unique' => 'Пользователь с таким Email же зарегестрирован',
            'rePassword.same' => 'Поле должно совадать с Паролем',
        ];
    }
}
