@extends('layout')
@section('title', 'LMS - главная страница')

@section ('content')
    <div class="main_page_content">
        @if (mb_strtolower($user->role->role_name) === \App\Models\Role::ROLE_ADMIN)
            {{--            <h1>Панель администратора</h1>--}}
            {{--            <br>--}}
            {{--            <a href="/users/list" class="btn btn-primary" role="button">Управление пользователями</a>--}}
            {{--            <a href="/courses" class="btn btn-primary" role="button">Управление курсами</a>--}}
            {{--            <a href="/target" class="btn btn-primary" role="button">Управление назначениями</a>--}}
            <img src="/img/rabbit.png" alt="" width="80%">
        @elseif (mb_strtolower($user->role->role_name) === \App\Models\Role::ROLE_MANAGER)
            {{--            <h1>Панель менеджера курсов</h1>--}}
            {{--            <br>--}}
            {{--            <a href="/courses" class="btn btn-primary" role="button">Управление курсами</a>--}}
            {{--            <a href="/target" class="btn btn-primary" role="button">Управление назначениями</a>--}}
        @else
            @if (!empty($appointmentCourses))
                <table class="table table-striped table-modify">
                    <tr>
                        <th>Название курса</th>
                        <th>Описание</th>
                        <th></th>
                    </tr>
                    @foreach($appointmentCourses as $course)
                        <tr>
                            <td>{{$course->name}}</td>
                            <td>{{$course->description}}</td>
                            <td><a href="/" class="btn btn-primary">Перейти к обучению</a>></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        @endif
    </div>
@endsection

