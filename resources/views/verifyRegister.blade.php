@extends('layout')
@section('title', 'LMS - подтверждение регистрации')

@section('style')
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    @if(isset($user))
        <div class = "position-absolute top-50 start-50 translate-middle p-3 col-md-9 border">
            <div class="text-center text-uppercase fw-weight-bold">Письмо с подтверждением регистрации отправлено
                на введенную Вами почту {{$user->email}}</div>
            <div class="text-center mt-3">Пройдите по ссылке, отправленной в письме, и завершите регистрацию</div>
            <div class="text-center mt-3">Если в течении минуты ничего не пришло
                <a style="pointer-events: none" class="repeat_message ms-3 btn btn-outline-primary">
                    Отправить письмо еще раз
                </a>
                <span class="timer_confirm"></span>
            </div>
            <div class="mt-3 text-center">
                <a href="/" class="btn btn-outline-info ms-2 d-inline">На главную</a>
                <a href="/register" class="btn btn-outline-info d-inline">На страницу регистрации</a>
            </div>
        </div>
    @endif
@endsection
@section('script')
    <script src="/assets/js/clock.js"></script>
@endsection
