@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    <h4>{{$course->name}}</h4>
    <br>
    <div><b>Автор: </b> {{$course->author->username}}</div>
    <div><b>Дата создания: </b> {{$course->created_at->format('Y-m-d')}}</div>
    @isset($course->updated_at)
        <div><b>Дата последнего редактирования: </b> {{$course->updated_at}}</div>
    @endif
    <div><b>Описание: </b> {{$course->description}}</div>
    <br>
    <div><b>Назначения: </b>
        <a href="/courses/{{$course->id}}/edit" class="btn btn-primary">Редактировать</a>
        <br>
    </div>
    <br>
    <div><b>Содержание курса: </b>
        <a href="/courses/{{$course->id}}/edit" class="btn btn-primary">Редактировать</a>

    </div>

    <br>

    <a href="/courses" class="btn btn-primary">
        Назад
    </a>
@endsection
