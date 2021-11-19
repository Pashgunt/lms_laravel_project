<?php

namespace App\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ValidateController
{
    protected array $config;

    use ValidatesRequests;

    public function __construct()
    {
        $this->config = require '../config/check-posts.php';
    }

    /** Метод проверки комплектности $_POST */
    public function checkPosts(string $form): bool
    {
        foreach ($this->config[$form] as $value) {
            if (!isset($_POST[$value])) {
                return false;
            }
        }

        return true;
    }

    public function checkPass(Request $request)
    {
        $this->validate($request, ['password' => 'match:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\w\s]).{6,}/']);
    }

    public function checkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'match:/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u']);
    }

    public function checkUsername(Request $request)
    {
        $this->validate($request, ['username' => 'match:/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/']);
    }
}
