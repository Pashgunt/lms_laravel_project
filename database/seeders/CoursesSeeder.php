<?php

namespace Database\Seeders;

use App\Models\Courses;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{

    public function run(): void
    {
        Courses::factory()->count(3)->create();
    }
}
