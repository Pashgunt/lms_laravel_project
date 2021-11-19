<?php

namespace App\Http\Controllers;

use http\Env\Request;

class ValidateController
{
    protected array $config;

    public function __construct()
    {
        $this->config = require_once '../../../config/check-posts.php';
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
        $validated = $request->valid([
            'title' => 'required|unique:posts|max:16',
            'password' => 'password:api'
        ]);
    }

}
