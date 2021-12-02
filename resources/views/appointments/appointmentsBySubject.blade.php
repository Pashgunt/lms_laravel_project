@extends('layout')
@if (isset($course))
    @section('title', 'LMS - список назначений для курса ' . $course->name)
@else
    @section('title', 'LMS - список назначений для студента ' . $user->username)
@endif

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')
    @if (isset($course))
        {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('target.course', $course) }}
        <h1>Список назначений для курса {{$course->name}}</h1>
    @else
        {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('target.student', $user) }}
        <h1>Список назначений для студента {{$user->username}}</h1>
    @endif

    <div class="usersTable">
        @if (isset($course->appointments))
            <table class="table table-striped table-modify">
                <tr>
                    <th>Студент</th>
                    <th>Дата назначения</th>
                    <th class="center">Действие</th>
                </tr>
                @foreach($course->appointments as $appointment)
                    <tr>
                        <td>{{$appointment->student->username ?? ''}}</td>
                        <td>{{$appointment->created_at}}</td>
                        <td class="center"><a class="confirm_delete btn btn-danger"
                                              href="/target/{{$appointment->id}}/destroy">Удалить</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            <table class="table table-striped table-modify">
                <tr>
                    <th>Курс</th>
                    <th>Дата назначения</th>
                    <th class="center">Действие</th>
                </tr>
                @foreach($user->appointments as $appointment)
                    <tr>
                        <td>{{$appointment->course->name ?? ''}}</td>
                        <td>{{$appointment->created_at}}</td>
                        <td class="center">
                            <a class="confirm_delete btn btn-danger" href="/target/{{$appointment->id}}/destroy">
                                Удалить</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
        <a href="{{$url}}" class="btn btn-primary mb-3">Назад к списку назначений</a>
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
