<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
/*
 * Генерация хлебных крошек
 */

/**
 * Главная страница
 */
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('index'));
});

/*
 * Список пользователей
 */
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('Список пользователей', route('users'));
});

/*
 * Список курсов
 */
Breadcrumbs::for('courses', function ($trail) {
    $trail->parent('home');
    $trail->push('Список курсов', route('courses'));
});

/*
 * Список назначений
 */
Breadcrumbs::for('target', function ($trail) {
    $trail->parent('home');
    $trail->push('Список назначений', route('target'));
});

/*
 * Страница редактирования пользователя
 */
Breadcrumbs::for('user', function ($trail, $user) {
    $trail->parent('users');
    $trail->push('Редактирование пользователя ' . $user->username, route('userDetail', $user->id));
});

/*
 * Страница создания нового курса
 */
Breadcrumbs::for('createCourse', function ($trail) {
    $trail->parent('courses');
    $trail->push('Создание нового курса', route('createCourse'));
});

/*
 * Страница редактирования курса
 */
Breadcrumbs::for('editCourse', function ($trail, $course) {
    $trail->parent('courses');
    $trail->push('Редактирование курса ' . $course->name, route('editCourse', $course->id));
});

/*
 * Страница детальной информации о курсе
 */
Breadcrumbs::for('courseDetail', function ($trail, $course) {
    $trail->parent('courses');
    $trail->push('Информация о курсе ' . $course->name, route('courseDetail', $course->id));
});

/*
 * создать назначение
 */
Breadcrumbs::for('createTarget', function ($trail, $pageCourse, $pageUser) {
    $trail->parent('target');
    $trail->push('Создать назначение', route('createTarget', [$pageCourse, $pageUser]));
});
