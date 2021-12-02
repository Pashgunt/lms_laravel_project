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
                    <th class="center">Дата назначения</th>
                    <th class="center">Статус</th>
                </tr>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{$appointment->course->name}}</td>
                        <td>{!!$appointment->course->description!!}</td>
                        <td class="center">{{$appointment->created_at}}</td>
                        @if ($appointment->passed_at === null)
                            <td class="center"><a href="/course/{{$appointment->course->id}}" class="btn btn-danger">Перейти</a></td>
                        @else
                            <td class="center"><a class="btn btn-success">Пройден</a></td>
                        @endif
                    </tr>
                @endforeach
            </table>
            {{ $appointments->links('vendor.pagination.bootstrap-4') }}
        @endif
    </div>
@endsection

