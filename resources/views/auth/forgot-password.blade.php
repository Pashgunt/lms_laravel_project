@extends('layout')

@section('style')
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    <section class="registration">
        <section class="registration__wrapper _container">
            <form action="{{ route('password.email') }}" method="post">
                <!-- Статус отправки -->
                <x-auth-session-status :status="session('status')" />

                <!-- Ошибка валидации -->
                <x-auth-validation-errors :errors="$errors" />
                @csrf
                <div class="registration__title _title">Восстановление пароля</div>
                <label class="registration__label _title">Почта
                    @error('email')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <br><input name="email" type="email" value="{{ old('email') }}"></label>
                <input type="submit" value="Отправить новый пароль" name="sendPassword">
            </form>
        </section>
    </section>
@endsection
