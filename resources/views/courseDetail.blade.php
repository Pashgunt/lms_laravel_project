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
    <div><b>Описание: </b> {!!$course->description!!}</div>
    <br>
    <div>
        <div class="head_menu">
            <div>
                <b>Содержание курса: </b><br>
                Приоритетность:
                <a href="/courses/{{$course->id}}/sort/priority/asc" style="color: blue">По возрастанию</a> /
                <a href="/courses/{{$course->id}}/sort/priority/desc" style="color: blue">По убыванию</a>
            </div>

            <form action="/courses/{{$course->id}}/activity/add" method="post">
                @csrf
                <label>
                    Добавление элемента -
                    <select name="activity_type">
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->name_rus}}</option>
                        @endforeach
                    </select>
                </label>
                <input type="submit" class="btn btn-success" value="Добавить">
            </form>
        </div>
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
                    <td>
                        <a href="/courses/activity/{{$activity->id}}">
                            {{$activity->name}}
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
    </div>
    <br/>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
