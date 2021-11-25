<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesTypeSeeder extends Seeder
{
    public array $types = [
      'text', 'test', 'video', 'image'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $type) {
            DB::table('activities_type')->insert([
                'name' => $type
            ]);
        }
    }
}
