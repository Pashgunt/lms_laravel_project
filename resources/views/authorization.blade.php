@extends('layout')

@section('style')
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    <section class="registration">
        <section class="registration__wrapper _container">
            <form action="/" method="post">
                @csrf
                <div class="registration__title _title">Авторизация</div>
                <label class="registration__label _title">Логин <br><input name="login" type="text"></label>
                <label class="registration__label _title"> Пароль <a href="/recovery" class = "registration__recovery">Забыли пароль?</a><br>
                    <input name="password" type="password">
                </label>
                <input type="submit" value="Авторизоваться" name="authUser">
            </form>
        </section>
    </section>
@endsection
