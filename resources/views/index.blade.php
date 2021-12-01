@extends('layout')
@section('title', 'LMS - главная страница')

@section ('content')
    <div class="main_page_content">
        @if (mb_strtolower($user->role->role_name) === \App\Models\Role::ROLE_ADMIN || \App\Models\Role::ROLE_MANAGER)
            <div class="rabbit">
                <img src="/img/rabbit.png" alt="" width="80%">
            </div>
        @elseif (!empty($appointmentCourses))
            <table class="table table-striped table-modify">
                <tr>
                    <th>Название курса</th>
                    <th>Описание</th>
                    <th></th>
                </tr>
                @foreach($appointmentCourses as $course)
                    <tr>
                        <td>{{$course->name}}</td>
                        <td>{!! $course->description !!}</td>
                        <td><a href="/" class="btn btn-primary">Перейти к обучению</a>></td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection

