<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesTextSeeder extends Seeder
{
    public int $count = 9;
    public array $properties = [
        'title' => 'Lorem ipsum dolor sit amet.',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias at cupiditate dolore eligendi in inventore officia porro, quibusdam ratione recusandae.'
    ];

    public function run()
    {
        for ($i = 0; $i < $this->count; $i++) {
            DB::table('activities_text')
                ->insert([
                'title' => $this->properties['title'] . "$i",
                'content' => $this->properties['content']
            ]);
        }
    }
}
