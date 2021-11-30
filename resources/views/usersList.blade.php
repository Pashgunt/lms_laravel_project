@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')

    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('users') }}

    <h1>Список пользователей</h1>
    <div class="usersTable">
        <table class="table table-striped table-modify">
            <tr>
                <th>Логин</th>
                <th>Почта</th>
                <th>Дата рождения</th>
                <th></th>
                <th></th>
            </tr>
            @if (isset($usersList))
                @foreach($usersList as $user)
                    <tr>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->date_birth}}</td>
                        <td><a href="/users/edit/{{$user->id}}" class="btn btn-primary">Информация</a></td>
                        <td>
                            <form action="/users/list/{{$user->id}}" method="get">
                                @csrf
                                <input type="hidden" name="userId" value="{{$user->id}}">
                                <input type="submit" name="deleteUser" value="Удалить"
                                       class="confirm_delete btn btn-danger"
                                        @if (Auth::user()->id === $user->id) disabled @endif>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
        {{ $usersList->links('vendor.pagination.bootstrap-4') }}
        <a href="/" class="btn btn-primary mb-3">На главную</a>
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
