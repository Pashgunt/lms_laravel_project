<?php

namespace Database\Seeders;

use App\Models\Activities;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{

    public string $text = 'Etiam rutrum elit vel dui fermentum, sed consectetur eros bibendum. Sed pharetra nisl lacus, non imperdiet ipsum fringilla non. Praesent viverra vulputate leo, vitae vulputate ipsum fringilla in. Mauris ornare pharetra augue, ut fermentum risus rutrum eget. Duis quis malesuada erat. Sed sit amet risus in libero porta iaculis. Aenean sed venenatis urna, ut faucibus leo. Morbi vitae convallis quam, id condimentum justo. Phasellus rutrum lacinia nunc in eleifend. Praesent dictum elit sit amet arcu eleifend, eu tristique ex fermentum. In vestibulum iaculis arcu, quis tincidunt nunc convallis fringilla. Donec rhoncus, dolor et interdum pulvinar, purus quam volutpat purus, ac sagittis ante arcu a urna. Nullam massa justo, interdum in enim eget, pellentesque posuere velit. Morbi sed maximus dui. Curabitur quis placerat neque.';
    public string $title = 'Lorem Ipsum';
    public int $countActivities = 9;
    public array $properties = [
        'course_id' => [1, 1, 1, 2, 2, 2, 3, 3, 3],
        'priority' => [1, 2, 3, 1, 2, 3, 1, 2, 3]
    ];


    public function run()
    {
        for ($i = 0; $i < $this->countActivities; $i++) {
            Activities::query()->insert([
                'course_id' => $this->properties['course_id'][$i],
                'text' => $this->text,
                'activity_type_id' => 1,
                'activity_title' => $this->title,
                'link' => null,
                'priority' => $this->properties['priority'][$i]
            ]);
        }
    }
}
