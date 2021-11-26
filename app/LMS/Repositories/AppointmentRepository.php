<?php

namespace App\LMS\Repositories;

use Illuminate\Http\Request;

class AppointmentRepository extends \App\LMS\Abstracts\Repositories
{
    public function updateOrCreateAppointment(Request $request): void
    {
        $data = json_decode($request->arr);

        foreach ($data->users as $user) {
            foreach ($data->courses as $course) {
                $this->model->updateOrCreate([
                    'course_id' => $course,
                    'user_id' => $user,
                ]);
            }
        }
    }
}
