<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Courses;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Фабрика для генерации назначений
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_id' => Courses::factory(),
            'user_id' => User::factory(),
        ];
    }
}
