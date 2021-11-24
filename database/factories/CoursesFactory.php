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
            'updated_at' => null,
            'author_id' => 1,
            'censorship_id' => 1,
            'description' => $this->faker->text()
        ];
    }
}
