@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    <h4>Список курсов</h4>

    <a href="/courses/create" class="btn btn-primary">
        Создать новый курс
    </a>

    <div class="usersTable">
        @if (isset($coursesList))
            <table class="table table-striped table-modify">
                <tr>
                    <th>Наименование</th>
                    <th>Автор</th>
                    <th>Описание</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($coursesList as $course)
                    <tr>
                        <td>{{$course->name}}</td>
                        <td>{{($course->author->username)}}</td>
                        <td>{{$course->description}}</td>
                        <td>
                            <a href="/courses/{{$course->id}}" class="btn btn-primary">
                                Информация
                            </a>
                        </td>
                        <td>
                            <a type="submit" class="btn btn-warning"
                               href="/courses/{{$course->id}}/edit">Редактировать</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="/courses/{{$course->id}}/destroy">Удалить</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $coursesList->links('vendor.pagination.bootstrap-4') }}
        @endif
    </div>
@endsection