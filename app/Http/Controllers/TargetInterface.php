<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\TargetRepository;
use App\Models\Courses;
use App\Models\User;

class TargetInterface extends Controller
{
    protected TargetRepository $repository;
    public User $user;
    public Courses $courses;

    public function allInfo()
    {
        $this->user = new User();
        $this->courses = new Courses();
        
        return view('interfaceForTarget', [
            'users' => $this->user->all(),
            'courses' => $this->courses->all()
        ]);
    }

}
