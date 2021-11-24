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
    <table class="table table-striped table-modify">
        <tr>
            <th>Наименование</th>
            <th>Автор</th>
            <th>Описание</th>
            <th></th>
            <th></th>
        </tr>
        @if (isset($coursesList))
            @foreach($coursesList as $course)
                <tr>
                    <td>{{$course->name}}</td>
                    <td>{{$course->author}}</td>
                    <td>{{$course->description}}</td>
                    <td>
                        <a href="/courses/{{$course->id}}" class="btn btn-primary">
                            Информация
                        </a>
                    </td>
                    <td>
                        <form action="" method="get">
                            @csrf
{{--                            <input type="hidden" name="detail" value="{{$course->id}}">--}}
                            <input type="submit" name="deleteUser" value="Удалить" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
</div>
@endsection
