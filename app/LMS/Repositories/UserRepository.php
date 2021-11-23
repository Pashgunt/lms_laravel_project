<?php

namespace App\LMS\Repositories;

use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function insertNewUser($request)
    {
        return $this->model::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'date_birth' => $request->input('date_birth'),
            'role_id' => 1,
        ]);
    }
}
