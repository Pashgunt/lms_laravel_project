<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/helper.js"></script>
    @yield ('style')
    @yield ('script')
</head>
<body>
<header class="header">
    <div class="header__wrapper _container">
        <a href="/" class="header__title _title">LMS</a>
        <div class="header__buttons">
            @if (Illuminate\Support\Facades\Auth::check())
                {{Auth::user()->username}}
                @if (mb_strtolower(Auth::user()->role->role_name) === \App\Models\Role::ROLE_ADMIN)
                    <a href="/users/list" class="header__registration" role="button">Панель администратора</a>
                @endif
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
        <div class="breadcrumbs">
            @if (isset($breadcrumbs))
                <a href="/">Главная</a>
                @foreach ($breadcrumbs as $link => $breadcrumb)
                    →
                    @if ($link)
                        <a href="{{$link}}"> {{$breadcrumb}}</a>
                    @else
                        {{$breadcrumb}}
                    @endif
                @endforeach
            @endif
        </div>
        @yield('content')
    </section>
</section>
</body>
</html>
