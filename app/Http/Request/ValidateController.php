<?php

namespace App\Http\Controllers;

class ValidateController
{
    protected array $config;

    public function __construct()
    {
        $this->config = require_once '../../../config/check-posts.php';
    }

    /** Метод проверки комплектности $_POST */
    public function checkPosts (string $form): bool
    {
        foreach ($this->config[$form] as $value) {
            if(!isset($_POST[$value])) {
                return false;
            }
        }

        return true;
    }


}
