<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new AdminSeeder)->run();
        (new ManagerSeeder)->run();
        (new UserSeeder)->run();
        (new RoleSeeder)->run();
        (new CoursesSeeder)->run();
        (new ActivitiesSeeder)->run();
        (new AuthorSeeder)->run();
    }
}
