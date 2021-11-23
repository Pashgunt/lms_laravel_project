@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/reg.css">
    <link rel="stylesheet" href="/assets/css/app.css">
@endsection

@section ('content')
    <section class="registration">
        <section class="registration__wrapper _container">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                         :value="old('email', $request->email)" required autofocus/>

                <x-label for="password" :value="__('Новый пароль')"/>

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required/>

                <!-- Confirm Password -->
                <x-label for="password_confirmation" :value="__('Подтвердить пароль: ')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required/>
                <x-button>
                    {{ __('Изменить пароль') }}
                </x-button>
            </form>
        </section>
    </section>
@endsection
