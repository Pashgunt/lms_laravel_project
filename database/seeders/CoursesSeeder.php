<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{

    public function run(): void
    {
        Course::factory()->count(20)->create();
    }
}
