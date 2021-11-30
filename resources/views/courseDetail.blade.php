@extends('layout')
@section('title', 'LMS - информация о курсе ' . $course->name)

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
@endsection

@section('content')
    @include('admin')
    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('courseDetail', $course) }}

    <h1>{{$course->name}}</h1>
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
        <a href="/courses/{{$course->id}}/sort/priority/asc" style="color: blue">По возрастанию</a> /
        <a href="/courses/{{$course->id}}/sort/priority/desc" style="color: blue">По убыванию</a>
        <table class="table">
            <tr>
                <td></td>
                <td>Название</td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($activities as $activity)
                <tr>
                    <td>{{$activity->priority}}</td>
                    <td><a href="/courses/activity/{{$activity->id}}">
                            {{$activity->activity_title}}
                        </a>
                    </td>
                    <td class="priority-change">
                        <a href="/courses/activity/{{$activity->id}}/up" class="btn arrow">
                            <img src="/assets/img/icons/arrow.png" alt="Up" class="revers-arrow">
                        </a>
                        <a href="/courses/activity/{{$activity->id}}/down" class="btn arrow">
                            <img src="/assets/img/icons/arrow.png" alt="Down">
                        </a>
                    </td>
                    <td>
                        <a href="/courses/activity/{{$activity->id}}/delete" class="confirm_delete">
                            <img src="/assets/img/icons/delete.png" alt="Delete" class="delete-icon">
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="/courses" class="btn btn-primary">Вернуться к списку курсов</a>
        <a href="/courses/{{$course->id}}/activity/add" class="btn btn-success">Добавить</a>
    </div>
    <br/>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
