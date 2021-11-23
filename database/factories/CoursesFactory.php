<?php

namespace Database\Factories;

use App\Models\Courses;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursesFactory extends Factory
{
    protected $model = Courses::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'created_at' => $this->faker->date(),
            'deleted_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
            'author' => $this->faker->name(),
            'censorship' => 18,
            'description' => $this->faker->text()
        ];
    }
}
