<?php

namespace App\LMS\Repositories;

use App\Models\Courses;
use App\Models\User;
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

    /**
     * Возвращает список назначений по студенту
     * @return mixed
     */
    public function getByUser(User $user)
    {
        return $this->model->where('user_id', '=',  $user->id);
    }

    public function getBySubjects(User $user, Courses $course)
    {
        return $this->model->where('user_id', '=',  $user->id)->where('course_id', '=', $course->id);
    }
}
