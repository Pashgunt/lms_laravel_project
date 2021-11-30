<?php

namespace Database\Seeders;

use App\LMS\Repositories\AppointmentRepository;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ManagerSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            CoursesSeeder::class,
            ActivitiesSeeder::class,
            AuthorSeeder::class,
            ActivitiesTypeSeeder::class,
            AppointmentSeeder::class,
            ActivitiesTextSeeder::class
        ]);
    }
}
