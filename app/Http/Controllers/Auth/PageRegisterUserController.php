<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class PageRegisterUserController extends Controller
{
    public function create()
    {
        return view('register');
    }
}
