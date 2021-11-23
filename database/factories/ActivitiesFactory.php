<?php

namespace Database\Factories;

use App\Models\Activities;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivitiesFactory extends Factory
{
    protected $model = Activities::class;

    public function definition(): array
    {
        return [
            'course_id' => 1,
            'text' => $this->faker->text(),
            'activity_type' => $this->faker->text(),
            'activity_title' => $this->faker->text(),
            'link' => $this->faker->text(),
            'priority' => 1,
        ];
    }
}
