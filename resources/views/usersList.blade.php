@extends('layout')
@section('title', 'LMS - список пользователей')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')

    <h1>Список пользователей</h1>
    <div class="usersTable">
        <table class="table table-striped table-modify">
            <tr>
                <td>Логин</td>
                <td>Почта</td>
                <td>Дата рождения</td>
                <td></td>
                <td></td>
            </tr>
            @if (isset($usersList))
                @foreach($usersList as $user)
                    <tr>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->date_birth}}</td>
                        <td>
                            <a href="/users/edit/{{$user->id}}" class="btn btn-primary">
                                Информация
                            </a>
                        </td>
                        <td>
                            <form action="/users/list/{{$pages['main_page']}}" method="post">
                                @csrf
                                <input type="hidden" name="userId" value="{{$user->id}}">
                                <input type="submit" name="deleteUser" value="Удалить"
                                       class="confirm_delete btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
        <div class="pagination">
            @if(isset($pages['min_page']))
                <a href="/users/list/{{$pages['min_page']}}"><b>Начало</b></a>
            @endif
            @if(isset($pages['prev_page']))
                <a href="/users/list/{{$pages['prev_page']}}">
                    <span style="padding: 0 5px">Назад</span>
                </a>
            @endif
            <a href="/users/list/{{$pages['main_page']}}">
                <span style="padding: 0 5px"> {{$pages['main_page']}} </span>
            </a>
            @if(isset($pages['next_page']))
                <a href="/users/list/{{$pages['next_page']}}">
                    <span style="padding: 0 5px"> - Следующая -</span>
                </a>
            @endif
            @if(isset($pages['max_page']))
                <a href="/users/list/{{$pages['max_page']}}"><b> Конец</b></a>
            @endif
        </div>
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
