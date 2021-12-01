@extends('layout')
@section('title', 'LMS - управление назначениями для студентов')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')
    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('students') }}
    <h1>Список назначений для студентов</h1>

    <a href="/target-interface" class="btn btn-primary">
        Создать назначение
    </a>

    <a href="/target" class="btn btn-primary">
        Список назначений по курсам
    </a>

    <div class="search_form">
        <form action="" method="get">
            <div class="input-group">
                <input type="text" name="search_user_field" class="form-control mb-2 mr-sm-2"
                       placeholder="Введите имя пользователя" value="{{$searchParam}}">
                <button type="submit" class="btn btn-primary mb-2">Найти</button>
            </div>
        </form>
    </div>

    <div class="usersTable">
        @if (!empty($searchResult) && $searchResult->count())
            <table class="table table-striped table-modify">
                <table class="table table-striped table-modify">
                    <tr>
                        <th>Студент</th>
                        <th class="center">Количество назначений</th>
                        <th class="center">Действие</th>
                    </tr>
                    @php($current = '')
                    @foreach($searchResult as $result)
                        @if ($current !== $result->username)
                            @php($current = $result->username)
                            <tr>
                                <td>{{$result->username ?? '<без имени>'}}</td>
                                <td class="center">{{$result->appointments->count() ?? ''}}</td>
                                <td class="center"><a class="btn btn-primary mb-3"
                                                      href="/target/students/{{$result->id}}">Просмотреть список
                                        курсов</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
                <a href="{{$url}}" class="btn btn-primary mb-3">Назад</a>
                @elseif ($searchParam)
                    <p>Студент не найден</p>
                    <a href="{{$url}}" class="btn btn-primary mb-3">Назад</a>
                @endif

                @if (!empty($appointments))
                    <table class="table table-striped table-modify">
                        <tr>
                            <th>Студент</th>
                            <th class="center">Количество назначений</th>
                            <th class="center">Действие</th>
                        </tr>
                        @php($current = '')
                        @foreach($appointments as $appointment)
                            @if ($current !== $appointment->student->username)
                                @php($current = $appointment->student->username)
                                <tr>
                                    <td>{{$appointment->student->username ?? '<без имени>'}}</td>
                                    <td class="center">{{$appointment->student->appointments->count() ?? ''}}</td>
                                    <td class="center"><a class="btn btn-primary mb-3"
                                                          href="/target/students/{{$appointment->student->id}}">Просмотреть
                                            список
                                            курсов</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                    {{ $appointments->links('vendor.pagination.bootstrap-4') }}
                    <a href="/" class="btn btn-primary mb-3">На главную</a>
        @endif
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
