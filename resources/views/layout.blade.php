<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS</title>
    <link rel="stylesheet" href="assets/css/app.css">

</head>
<body>
<header class="header">
    <div class="header__wrapper _container">
        <span class="header__title _title">LMS</span>
        <div class="header__buttons">
            <input type="submit" value="Регистрация" name="registration" class="header__registration">
            <input type="submit" value="Авторизация" name="login" class="header__registration">
        </div>
    </div>
</header>
<section class="content">
    <section class="content__wrapper _container"></section>
</section>
<footer class="footer">
    <section class="footer__wrapper _container"></section>
</footer>
</body>
</html>
