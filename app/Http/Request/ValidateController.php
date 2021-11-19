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
        $this->validate($request, ['password' => 'required|confirmed|min:6']);
    }

    public function checkEmail(Request $request)
    {
        $this->validate($request, ['password' => [
            'required', 'email:rfc',
            function ($attribute, $value, $fail) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $fail($attribute . ' is invalid.');
                }
            }],]);
    }
}
