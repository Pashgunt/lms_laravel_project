@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    <h4>Список назначений</h4>

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
                        <td>{{$appointment->course->first()->name}}</td>
                        <td>{{($appointment->student->first()->username)}}</td>
                        <td>
                            <a class="btn btn-danger" href="/target/{{$appointment->id}}/destroy">Удалить</a>
                        </td>
                    </tr>
                @endforeach
            </table>

            {{ $appointments->links('vendor.pagination.bootstrap-4') }}
        @endif
    </div>
@endsection
