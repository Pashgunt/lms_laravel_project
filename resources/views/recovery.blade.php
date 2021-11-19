@extends('layout')

@section('style')
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    <section class="registration">
        <section class="registration__wrapper _container">
            <form action="/" method="post">
                @csrf
                <div class="registration__title _title">Восстановление пароля</div>
                <label class="registration__label _title">Почта <br><input name="email" type="email"></label>
                <input type="submit" value="Отправить новый пароль" name="sendPassword">
            </form>
        </section>
    </section>
@endsection
