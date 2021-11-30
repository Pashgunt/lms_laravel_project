<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesTextSeeder extends Seeder
{
    public int $count = 9;
    public array $properties = [
        'activity_id' => [1, 2, 3, 4, 5, 6, 7, 8, 9],
        'title' => 'Lorem ipsum dolor sit amet.',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias at cupiditate dolore eligendi in inventore officia porro, quibusdam ratione recusandae.'
    ];

    public function run()
    {
        for ($i = 0; $i < $this->count; $i++) {
            DB::table('activities_text')->insert([
                'activity_id' => $this->properties['activity_id'][$i],
                'title' => $this->properties['title'][$i],
                'content' => $this->properties['content'][$i]
            ]);
        }
    }
}
