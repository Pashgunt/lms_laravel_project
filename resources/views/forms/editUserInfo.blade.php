@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')
    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('user', $user) }}

    <h1 class="head">Редактирование информации о пользователе</h1>
    <div class="editUserInfo">
        <form action="/users/edit/{{$user->id}}" method="post">
            @csrf
            <label>
                @error('username')
                <div class="alert-danger">{{ $message }}</div>
                @enderror
                ФИО - <input type="text" name="username" value="{{$user->username}}">
            </label><br>
            <label>
                @error('email')
                <div class="alert-danger">{{ $message }}</div>
                @enderror
                Почта - <input type="text" name="email" value="{{$user->email}}">
            </label><br>
            <label>
                @error('date_birth')
                <div class="alert-danger">{{ $message }}</div>
                @enderror
                Дата рождения - <input type="text" name="date_birth" value="{{$user->date_birth}}">
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
            <a href="/users/list/?page=1" class="btn btn-primary">Назад</a>
            <input type="submit" name="editUserInfo" value="Сохранить" class="btn btn-success">
        </form>
    </div>
@endsection
