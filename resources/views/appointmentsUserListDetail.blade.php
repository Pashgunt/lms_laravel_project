@extends('layout')
@section('title', 'LMS - список назначений для студента ' . $user->username)

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')
    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('target.student', $user) }}
    <h1>Список назначений для студента {{$user->username}}</h1>

    <div class="usersTable">
        @if ($user->appointments)
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
                        <td class="center"><a class="confirm_delete btn btn-danger"
                                              href="/target/{{$appointment->id}}/destroy">Удалить</a></td>
                    </tr>
                @endforeach
            </table>
{{--            {{ $user->appointments->links('vendor.pagination.bootstrap-4') }}--}}
            <a href="/target" class="btn btn-primary mb-3">Назад к списку назначений</a>
        @endif
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
