@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
    <link rel="stylesheet" href="/assets/css/pagination.css">
@endsection

@section('content')
<h4>Список пользователей</h4>
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
                        <form action="/users/list/?page={{$page}}" method="post">
                            @csrf
                            <input type="hidden" name="userId" value="{{$user->id}}">
                            <input type="submit" name="deleteUser" value="Удалить" class="confirm_delete btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
    <a href="{{$url}}" class = "btn btn-primary mb-3">Назад</a>
    {{ $usersList->links('vendor.pagination.bootstrap-4') }}
</div>
<script src="/assets/js/delete-confirm.js"></script>
@endsection
