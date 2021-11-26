<?php

namespace App\LMS\Repositories;

use Illuminate\Http\Request;
use App\LMS\Abstracts\Repositories;

class AppointmentRepository extends Repositories
{
    public function updateOrCreateAppointment(Request $request): void
    {
        $data = json_decode($request->arr);
        foreach ($data->courses as $course) {
            foreach ($data->users as $user) {
                var_dump($course, $user);
                $this->model->updateOrCreate([
                    'course_id' => $course,
                    'user_id' => $user,
                ],[]);
            }
        }
    }

    /**
     * Сортировка по назначениям
     * @return mixed
     */
    public function orderByRaw(string $string)
    {
        return $this->model->orderByRaw($string);
    }
}
