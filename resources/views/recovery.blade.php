@extends('layout')

@section ('content')
    <section class="registration">
        <section class="registration__wrapper _container">
            <form action="/" method="post">
                @csrf
                <span class="registration__title _title">Восстановление пароля</span>
                <label class="_title">Почта <br><input name="email" type="email"></label>
                <input type="submit" value="Отправить новый пароль" name="sendPassword">
            </form>
        </section>
    </section>
@endsection
