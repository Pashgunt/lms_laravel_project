<?php

namespace Database\Seeders;

use App\Models\Activities;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activities::factory()->count(3)->create();
    }
}
