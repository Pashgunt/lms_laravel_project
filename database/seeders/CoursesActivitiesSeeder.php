<?php

namespace Database\Seeders;

use App\Models\CoursesActivitiesModel;
use Illuminate\Database\Seeder;

class CoursesActivitiesSeeder extends Seeder
{
    public int $countActivities = 9;
    public array $properties = [
        'courses_id' => [1, 1, 1, 2, 2, 2, 3, 3, 3],
        'priority' => [1, 2, 3, 1, 2, 3, 1, 2, 3]
    ];


    public function run()
    {
        for ($i = 0; $i < $this->countActivities; $i++) {
            CoursesActivitiesModel::query()->insert([
                                                        'courses_id' => $this->properties['courses_id'][$i],
                                                        'activity_id' => $i + 1,
                                                        'priority' => $this->properties['priority'][$i],
                                                        'created_at' => date('Y-m-d h:m:s'),
                                                        'updated_at' => date('Y-m-d h:m:s')
                                                    ]);
        }
    }
}
