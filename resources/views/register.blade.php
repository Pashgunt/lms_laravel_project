@extends('layout')

@section('style')
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    <section class="registration mt-5">
        <section class="registration__wrapper _container position-relative">
            <div class="registration__helper position-absolute top-50 start-100 translate-middle-y w-50" style="font-size: 14px">
                <ul>
                    <li>
                        Поле с Именем пользователем (ФИО) должно быть обяхательно к заполнению.
                        Состоять из строчных символов и состоять мнимум из 10 символов.
                    </li>
                    <li>
                        Поле с Email должно быть обязательно к заполнению.
                        Иметь тип почты, т.е. содержать символ @ и адрес любого постинга для почты.
                        Должно быть уникальным, 2 раза с одной и той же почтой зарегестрироваться нельзя.
                    </li>
                    <li>
                        Поле Даты рождения должно быть обязательно к заполнению.
                        Иметь формат даты, т.е. DD.MM.YYYY.
                        Пользователь долж быть совершенолетним.
                    </li>
                    <li>
                        Пароль является обызательным к заполнению.
                        Иметь минимум 8 символов, содержать буквенные, симольные и числовые значения в разном регистре.
                    </li>
                    <li>
                        Поле Подтверждение пароля должно совпадать с полем пароля.
                    </li>
                </ul>
                <div class = "col-md-6 offset-md-3 mt-2 btn btn-danger button_close_reg_helper">Закрыть</div>
            </div>
            <form action="/register" method="post">
                @csrf
                <div class="registration__title _title">Регистрация</div>
                <label class="registration__label _title">Имя пользователя
                    @error('username')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <br><input name="username" type="text" value="{{ old('username') }}"></label>
                <label class="registration__label _title">Почта
                    @error('email')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <br><input name="email" type="email" value="{{ old('email') }}"></label>
                <label class="registration__label _title">Дата рождения
                    @error('date_birth')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <br><input name="date_birth" type="date" value="{{ old('date_birth') }}">
                </label>
                <label class="registration__label _title">Пароль
                    @error('password')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <br><input name="password" type="password">
                </label>
                <label class="registration__label _title">Подтверждение пароля
                    @error('rePassword')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <br><input name="rePassword" type="password">
                </label>
                <input type="submit" value="Зарегестрироваться" name="register">
                <div class = "register__helper__button btn btn-secondary mt-3">Подсказка к регистрации</div>
            </form>
        </section>
    </section>
@endsection
