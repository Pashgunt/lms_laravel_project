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
            'name' => $this->faker->text(30),
            'created_at' => date('Y-m-d h:m:s'),
            'updated_at' => date('Y-m-d h:m:s'),
            'author_id' => 1,
            'description' => $this->faker->text()
        ];
    }
}
