<?php

namespace App\Http\Requests\ValidateRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActivityRequest extends FormRequest
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
            'activity_type_id' => Rule::requiredIf(function () {
            }),
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
            'activity_title.required' => 'Поле обязательно к заполнению',
            'activity_title.not_regex' => 'Не должно быть спецсимволов',
            'activity_text.required' => 'Поле обязательно к заполнению',
            'activity_title.regex' => 'Проверьте введенные вами данные',
            'activity_text.regex' => 'Проверьте введенные вами данные',
            'activity_title.min' => 'Минимум 10 символов',
            'activity_text.min' => 'Минимум 50 символов',
            'activity_title.max' => 'Максимум 50 символов',
            'activity_text.max' => 'Максимум 255 символов',
        ];
    }

    public function makeDTO()
    {

        return new nameDTO($this->validated());
    }
}
