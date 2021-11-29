@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
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
    <div>
        <b>Содержание курса: </b><br>
        Приоритетность:
        <a href="/courses/{{$course->id}}/sort/priority/asc" style="color: blue">По возрастанию</a>
        <a href="/courses/{{$course->id}}/sort/priority/desc" style="color: blue">По убыванию</a>
        <table class="table table-striped table-modify">
            <tr>
                <td></td>
                <td>Название</td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($activities as $activity)
                <tr>
                    <td>{{$activity->priority}}</td>
                    <td>{{$activity->activity_title}}</td>
                    <td class="priority-change">
                        <a href="/courses/activity/{{$activity->id}}/up" class="btn arrow">
                            <img src="/assets/img/icons/arrow.png" alt="Up" class="revers-arrow">
                        </a>
                        <a href="/courses/activity/{{$activity->id}}/down" class="btn arrow">
                            <img src="/assets/img/icons/arrow.png" alt="Down">
                        </a>
                    </td>
                    <td>
                        <a href="/courses/activity/{{$activity->id}}" class="btn btn-primary">Перейти</a>
                        <a href="/courses/activity/{{$activity->id}}/delete" class="btn btn-danger">Удалить</a>
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
