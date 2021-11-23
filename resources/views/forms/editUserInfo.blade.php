@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    <h4 class="head">Редактирование информации о пользователе</h4>
    <div class="editUserInfo">
        <form action="/users/edit/{{$userId}}" method="post">
            @csrf
            @foreach ($userInfo as $user)
                <label>
                    Логин - <input type="text" name="username" value="{{$user->username}}">
                    @error('username')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </label><br>
                <label>
                    Почта - <input type="text" name="email" value="{{$user->email}}">
                    @error('email')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </label><br>
                <label>
                    Дата рождения - <input type="text" name="date_birth" value="{{$user->date_birth}}">
                    @error('date_birth')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </label><br>
                <select name="role_id">
                    @foreach($roles as $role)
                        @if($role->id === $user->role_id)
                            <option value="{{$role->id}}" selected>{{$role->role_name}}</option>
                        @else
                            <option value="{{$role->id}}">{{$role->role_name}}</option>
                        @endif
                    @endforeach
                </select><br>
            @endforeach
                <a href="/users/list/1" class="btn btn-primary">Назад</a>
            <input type="submit" name="editUserInfo" value="Сохранить" class="btn btn-success">
        </form>
    </div>
@endsection
