@extends('layout')
@section('title', 'LMS - управление назначениями')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')
    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('target') }}
    <h1>Список назначений</h1>

    <a href="/target-interface/1/1" class="btn btn-primary">
        Создать назначение
    </a>

    <div class="usersTable">
        @if (isset($appointments))
            <table class="table table-striped table-modify">
                <tr>
                    <th></th>
                    <th>Название курса</th>
                    <th>Id курса</th>
                    <th>Студент</th>
                    <th>Id студента</th>
                    <th></th>
                    <th></th>
                </tr>

                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{$appointment->id}}</td>
                        <td>{{$appointment->course->name ?? ''}}</td>
                        <td>{{$appointment->course->id ?? ''}}</td>
                        <td>{{$appointment->student->username ?? ''}}</td>
                        <td>{{$appointment->student->id ?? ''}}</td>
                        <td>
                            <a class="confirm_delete btn btn-danger"
                               href="/target/{{$appointment->id}}/destroy">Удалить</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $appointments->links('vendor.pagination.bootstrap-4') }}
            <a href="/" class="btn btn-primary mb-3">На главную</a>
        @endif
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
