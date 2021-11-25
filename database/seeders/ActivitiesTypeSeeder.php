<?php

namespace Database\Seeders;

use App\Models\ActivitiesType;
use Illuminate\Database\Seeder;

class ActivitiesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivitiesType::factory()->create();
    }
}
