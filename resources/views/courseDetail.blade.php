@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
@endsection

@section('content')
    <h4>{{$course->name}}</h4>
    <br>
    <div><b>Автор: </b> {{$course->author}}</div>
    <div><b>Дата создания: </b> {{$course->created_at}}</div>
    @isset($course->updated_at)
        <div><b>Дата последнего редактирования: </b> {{$course->updated_at}}</div>
    @endif
    <div><b>Описание: </b> {{$course->description}}</div>
    <br>
    <div><b>Назначения: ПЕРЕНОСИМ на отдельную страницу</b></div>
    <br>
    <div><b>Содержание курса: </b>
        <table class="table table-striped table-modify">
            <tr>
                <td></td>
                <td>Название</td>
                <td></td>
            </tr>
            @foreach ($activities as $activity)
                <tr>
                    <td>{{$activity->priority}}</td>
                    <td>{{$activity->activity_title}}</td>
                    <td>
                        <a href="/courses/activity/{{$activity->id}}" class="btn btn-primary">Перейти</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="/courses/{{$course->id}}/activity/add" class="btn btn-success">Добавить</a>
    </div>

    <br>

    <a href="/courses" class="btn btn-primary">
        Назад
    </a>
@endsection
