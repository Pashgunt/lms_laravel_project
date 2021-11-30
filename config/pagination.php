<?php

/**
 * Конфигурация пагинации
 *
 * Возможность указать отдельное количество для вывода на страницу
 */
return [
    'user' => env('PAGINATION_USER', 10),
    'course' => env('PAGINATION_COURSE', 10),
    'appointment' => env('PAGINATION_APPOINTMENT', 10),
];
