<?php

namespace App\Http\Requests\ValidateRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UserRequest extends FormRequest
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
        $date = Carbon::now()->subYears(5);

        return [
            'email' => 'required| email',
            'username' => 'required|string|min:10',
            'date_birth' => 'required|date|before_or_equal:' . $date
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
            'date_birth.required' => 'Поле обязательно к заполнению',
            'date_birth.date' => 'Введенные данные должны соответствовать типу даты',
            'date_birth.before_or_equal' => 'Вам должно быть больше 18 лет',
        ];
    }
}
