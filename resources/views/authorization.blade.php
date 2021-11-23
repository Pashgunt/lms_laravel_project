@extends('layout')

@section('style')
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    <section class="registration">
        <section class="registration__wrapper _container">
            <form action="/login" method="post">
                @csrf
                @if(session()->has('message'))
                    {{session()->get('message')}}
                @endif
                <div class="registration__title _title">Авторизация</div>
                <label class="registration__label _title">Электронная почта
{{--                    @error('login')--}}
{{--                    <div class="alert-danger">{{ $message }}</div>--}}
{{--                    @enderror--}}
                    <br><input name="email" type="text" value="{{ old('login') }}"></label>
                <label class="registration__label _title"> Пароль
{{--                    @error('password')--}}
{{--                    <div class="alert-danger">{{ $message }}</div>--}}
{{--                    @enderror--}}
                    <a href="/recovery" class="registration__recovery">Забыли пароль?</a><br>
                    <input name="password" type="password">
                </label>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        Неправильное имя пользователя или пароль
                    </div>
                @endif
                <br>
                <input type="submit" value="Авторизоваться" name="authUser">
            </form>
        </section>
    </section>
@endsection
