@extends('layout')

@section('style')
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    <section class="registration">
        <section class="registration__wrapper _container">
            <form action="/register" method="post">
                @csrf
                <span class="registration__title _title">Регистрация</span>
                <label class="_title">Имя пользователя <br><input name="username" type="text"></label>
                <label class="_title">Почта <br><input name="email" type="email"></label>
                <label class="_title">Пароль <br><input name="password" type="password"></label>
                <label class="_title">Подтверждение пароля <br><input name="rePassword" type="password"></label>
                <input type="submit" value="Зарегестрироваться" name="register">
            </form>
        </section>
    </section>
@endsection
