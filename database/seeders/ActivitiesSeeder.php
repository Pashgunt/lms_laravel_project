<?php

namespace Database\Seeders;

use App\Models\Activities;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    public int $countActivities = 9;
    public array $properties = [
        'name' => [
            'Element1',
            'Element2',
            'Element3',
            'Element4',
            'Element5',
            'Element6',
            'Element7',
            'Element8',
            'Element9'
        ],
        'activity_type_id' => 1,
        'additional' => [
            'title' => 'Example title',
            'content' => 'Example content',
        ]
    ];


    public function run()
    {
        for ($i = 0; $i < $this->countActivities; $i++) {
            Activities::query()->insert([
                'name' => $this->properties['name'][$i],
                'activity_type_id' => $this->properties['activity_type_id'],
                'additional' => json_encode(serialize($this->properties['additional'])),
                'created_at' => date('Y-m-d h:m:s'),
                'updated_at' => date('Y-m-d h:m:s'),
            ]);
        }
    }
}
