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
            RoleSeeder::class,
            AdminSeeder::class,
            ManagerSeeder::class,
            UserSeeder::class,
            CoursesSeeder::class,
            ActivitiesTypeSeeder::class,
            ActivitiesSeeder::class,
            AppointmentSeeder::class,
        ]);
    }
}
