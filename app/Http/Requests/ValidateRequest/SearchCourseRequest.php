<?php

namespace App\Http\Requests\ValidateRequest;

use Illuminate\Foundation\Http\FormRequest;

class SearchCourseRequest extends FormRequest
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
            'search_course_field' => 'required|string|max:50',
        ];
    }

    /**
     * Метод для перевода атрибутов ошибок с en на ru
     */
    public function attributes(): array
    {
        return [
            'search_course_field' => 'Имя пользователя',
        ];
    }

    /**
     * Метод для вывода всех возможных ошибок, которые появляются после прохождения по правилам валидации
     * Описанных в методе rules()
     */
    public function messages(): array
    {
        return [
            'search_course_field.required' => 'Поле обязательно к заполнению',
            'search_course_field.string' => 'Проверьте введенные вами данные',
            'search_course_field.max' => 'Максимум 50 символов',
        ];
    }
}
