<?php

namespace Database\Factories;

use App\Models\Authors;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorsFactory extends Factory
{
    protected $model = Authors::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'authors' => $this->faker->name()
        ];
    }
}
