<?php

namespace App\Http\Requests\ValidateRequest;

use App\LMS\DTO\CourseDTO;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'required|
                            string|
                            min:4|
                            max:255|
                            not_regex:/(=[@#$%^&*])/',
            'description' => 'required|
                             string|
                             min:10|
                             max:5000',
        ];
    }

    /**
     * Метод для перевода атрибутов ошибок с en на ru
     */
    public function attributes(): array
    {
        return [
            'name' => 'название',
            'description' => 'описание',
        ];
    }

    /**
     * Метод для вывода всех возможных ошибок, которые появляются после прохождения по правилам валидации
     * Описанных в методе rules()
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле обязательно к заполнению',
            'name.not_regex' => 'Не должно быть спецсимволов',
            'description.required' => 'Поле обязательно к заполнению',
            'name.regex' => 'Проверьте введенные данные ',
            'description.regex' => 'Проверьте введенные данные',
            'name.min' => 'Минимум 4 символов в названии курса',
            'description.min' => 'Минимум 10 символов в описании курса',
            'name.max' => 'Максимум 50 символов в названии курса',
            'description.max' => 'Максимум 5000 символов в описании курса',
        ];
    }

    /**
     * DTO Курсов
     *
     * Передаем в DTO валидированные параметры
     *
     */
    public function makeDTO(): CourseDTO
    {
        $validated = $this->validated();

        $name = $validated['name'];
        $description = $validated['description'];

        return new CourseDTO($name, $description);
    }
}
