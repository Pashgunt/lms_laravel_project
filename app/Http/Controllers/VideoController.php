<?php

namespace App\Http\Controllers;

/**
 * Отдаёт тестовую страницу с плеером
 */
class VideoController
{
    public function play()
    {
        return view('video');
    }
}
