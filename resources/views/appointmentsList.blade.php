@extends('layout')
@section('title', 'LMS - управление назначениями')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    <h1>Список назначений</h1>
    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('target') }}

    <a href="/target-interface/1/1" class="btn btn-primary">
        Создать назначение
    </a>

    <div class="usersTable">
        @if (isset($appointments))
            <table class="table table-striped table-modify">
                <tr>
                    <th>Название курса</th>
                    <th>Студент</th>
                    <th></th>
                </tr>
                @foreach($appointments as $appointment)
                    <tr>
                        @if ($appointment->course->first()->name !== $current_course)
                            <td>{{$appointment->course->first()->name}}</td>
                            @php ($current_course = $appointment->course->first()->name)
                        @else
                            <td></td>
                        @endif
                            <td>
                                {{($appointment->student->first()->username)}}</td>
                            <td>
                                <a class="confirm_delete btn btn-danger" href="/target/{{$appointment->id}}/destroy">Удалить</a>
                            </td>
                    </tr>
                @endforeach
            </table>
            {{ $appointments->links('vendor.pagination.bootstrap-4') }}
            <a href="/" class = "btn btn-primary mb-3">На главную</a>
        @endif
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
