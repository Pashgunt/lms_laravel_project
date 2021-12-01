@extends('layout')
@section('title', 'LMS - список назначений для курса ' . $course->name)

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')
    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('target.course', $course) }}
    <h1>Список назначений для курса {{$course->name}}</h1>

    <div class="usersTable">
        @if ($course->appointments)
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
            <a href="/target" class="btn btn-primary mb-3">Назад к списку назначений</a>
        @endif
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
