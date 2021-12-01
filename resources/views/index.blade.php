@extends('layout')
@section('title', 'LMS - главная страница')

@section ('content')
    <div class="main_page_content">
        @if (mb_strtolower($user->role->role_name) === \App\Models\Role::ROLE_ADMIN || mb_strtolower($user->role->role_name) === \App\Models\Role::ROLE_MANAGER)
            <div class="rabbit">
                <img src="/img/rabbit.png" alt="" width="80%">
            </div>
        @elseif (!empty($appointments))

            <table class="table table-striped table-modify">
                <tr>
                    <th>Название курса</th>
                    <th>Описание</th>
                    <th></th>
                </tr>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{$appointment->course->name}}</td>
                        <td>{!! $appointment->course->description !!}</td>
                        <td><a href="/course/{{$appointment->course->id}}" class="btn btn-primary">Перейти к обучению</a></td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection

