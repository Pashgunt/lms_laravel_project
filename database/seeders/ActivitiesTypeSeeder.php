<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesTypeSeeder extends Seeder
{
    public array $types = [
        'name' => ['text', 'test', 'video', 'image'],
        'name_rus' => ['Текст', 'Тест', 'Видео', 'Изображение']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count($this->types['name']); $i++) {
            DB::table('activities_type')->insert([
                'name' => $this->types['name'][$i],
                'name_rus' => $this->types['name_rus'][$i]
            ]);
        }
    }
}
