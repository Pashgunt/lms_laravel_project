<?php

namespace Database\Seeders;

use App\Models\Activities;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    public int $countActivities = 9;
    public array $properties = [
        'course_id' => [1, 1, 1, 2, 2, 2, 3, 3, 3],
        'type_id' => 1,
        'priority' => [1, 2, 3, 1, 2, 3, 1, 2, 3],
        'content_id' => [1, 2, 3, 4, 5, 6, 7, 8, 9],
    ];


    public function run()
    {
        for ($i = 0; $i < $this->countActivities; $i++) {
            Activities::query()->insert([
                'course_id' => $this->properties['course_id'][$i],
                'type_id' => $this->properties['type_id'],
                'content_id' => $this->properties['content_id'][$i],
                'priority' => $this->properties['priority'][$i],
                'created_at' => '2021-11-30 11:02:20',
                'updated_at' => '2021-11-30 11:02:20'
            ]);
        }
    }
}
