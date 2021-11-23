@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
<h4>Список курсов</h4>
<div class="usersTable">
    <table class="table table-striped table-modify">
        <tr>
            <td>Наименование</td>
            <td>Автор</td>
            <td>Описание</td>
            <td></td>
            <td></td>
        </tr>
        @if (isset($coursesList))
            @foreach($coursesList as $course)
                <tr>
                    <td>{{$course->name}}</td>
                    <td>{{$course->author}}</td>
                    <td>{{$course->description}}</td>
                    <td>
                        <a href="/users/edit/{{$course->id}}" class="btn btn-primary">
                            Информация
                        </a>
                    </td>
                    <td>
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="userId" value="{{$course->id}}">
                            <input type="submit" name="deleteUser" value="Удалить" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
</div>
@endsection
