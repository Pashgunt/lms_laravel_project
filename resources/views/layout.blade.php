<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS</title>
    <link rel="stylesheet" href="assets/css/app.css">
    @yield ('style')
</head>
<body>
<header class="header">
    <div class="header__wrapper _container">
        <a href="/" class="header__title _title">LMS</a>
        <div class="header__buttons">
            <a href="/login" class="header__registration">Авторизация</a>
            <a href="/register" class="header__registration"> Регистрация</a>
        </div>
    </div>
</header>
<section class="content">
    <section class="content__wrapper _container">
        @yield('content')
    </section>
</section>
<footer class="footer">
    <section class="footer__wrapper _container"></section>
</footer>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="assets/js/wysiwyg.js"></script>
</body>
</html>
