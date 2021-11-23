@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/errors.css">
@endsection

@section ('content')
    <div class="error">
        <h3>Пользователь с запрашиваемым ID - не найден.</h3>
        <a href="/users/list/1">К списку</a>
    </div>
@endsection
