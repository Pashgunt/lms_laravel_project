<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/app.css">
    @yield ('style')
    @yield ('script')
</head>
<body>
<header class="header">
    <div class="header__wrapper _container">
        <a href="/" class="header__title _title">LMS</a>
        <div class="header__buttons">
            @if (Illuminate\Support\Facades\Auth::check())
                <a href="/courses" class="header__registration">Список курсов</a>
                <a href="/users/list" class="header__registration">Список пользователей</a>
                <a href="/logout" class="header__registration">Выйти</a>
            @else
                <a href="/login" class="header__registration">Авторизация</a>
                <a href="/register" class="header__registration"> Регистрация</a>
            @endif
        </div>
    </div>
</header>
<section class="content">
    <section class="content__wrapper _container">
        @yield('content')
    </section>
</section>
<footer class="footer">
    <section class="footer__wrapper _container">
    </section>
</footer>
</body>
</html>
