<?php

namespace App\LMS\Repositories;

use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function insertNewUser($user, $request)
    {
        return $user::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'date_birth' => $request->input('date_birth'),
            'role_id' => 1,
        ]);
    }
}
