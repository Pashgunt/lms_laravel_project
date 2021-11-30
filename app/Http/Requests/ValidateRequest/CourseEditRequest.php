<?php

namespace App\Http\Requests\ValidateRequest;

use Illuminate\Foundation\Http\FormRequest;

class CourseEditRequest extends FormRequest
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
            'nameCourse' => 'required|
                            string|
                            min:4|
                            max:50|
                            not_regex:/(=[@#$%^&*])/',
            'descCourse' => 'required|
                             string|
                             max:255',
        ];
    }

    /**
     * Метод для перевода атрибутов ошибок с en на ru
     */
    public function attributes(): array
    {
        return [
            'nameCourse' => 'Название курса',
            'descCourse' => 'Описание курса',
        ];
    }

    /**
     * Метод для вывода всех возможных ошибок, которые появляются после прохождения по правилам валидации
     * Описанных в методе rules()
     */
    public function messages(): array
    {
        return [
            'nameCourse.required' => 'Поле обязательно к заполнению',
            'nameCourse.not_regex' => 'Не должно быть спецсимволов',
            'descCourse.required' => 'Поле обязательно к заполнению',
            'nameCourse.regex' => 'Проверьте введенные данные ',
            'descCourse.regex' => 'Проверьте введенные данные',
            'nameCourse.min' => 'Минимум 10 символов в названии курса',
            'descCourse.min' => 'Минимум 50 символов в описании курса',
            'nameCourse.max' => 'Максимум 50 символов в названии курса',
            'descCourse.max' => 'Максимум 255 символов в описании курса',
        ];
    }
}
