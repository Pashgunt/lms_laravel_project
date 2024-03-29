<?php

namespace App\Http\Requests\ValidateRequest;

use Illuminate\Foundation\Http\FormRequest;

class RecoveryRequest extends FormRequest
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
            'email' => 'required|email',
        ];
    }

    /**
     * Метод для перевода атрибутов ошибок с en на ru
     */
    public function attributes(): array
    {
        return [
            'email' => 'E-mail',
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
        ];
    }
}
