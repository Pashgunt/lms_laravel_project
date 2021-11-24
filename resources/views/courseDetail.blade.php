@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    <h4>{{$course->name}}</h4>
    <br>
    <div><b>Автор: </b> {{$course->author->username}}</div>
    <div><b>Дата создания: </b> {{$course->created_at}}</div>
    @isset($course->updated_at)
        <div><b>Дата последнего редактирования: </b> {{$course->updated_at}}</div>
    @endif
    <div><b>Описание: </b> {{$course->description}}</div>
    <br>
    <div><b>Назначения: </b>
        <a href="/courses/{{$course->id}}/edit" class="btn btn-primary">Редактировать</a>
        <br>
        <table>
            <tr>
                <td>Пользователь 1</td>
                <td width="30%">Выполнил</td>
            </tr>
            <tr>
                <td>Пользователь 2</td>
                <td>Выполнил</td>
            </tr>
            <tr>
                <td>Пользователь 3</td>
                <td>Выполнил</td>
            </tr>
            <tr>
                <td>Пользователь 4</td>
                <td>Не приступил</td>
            </tr>
        </table>
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
