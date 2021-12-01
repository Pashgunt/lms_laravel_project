@extends('layout')
@section('title', 'LMS - список назначений для курсов')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')
    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('target') }}
    <h1>Список назначений по курсам</h1>

    <a href="/target-interface" class="btn btn-primary">
        Создать назначение
    </a>

    <a href="/target/students" class="btn btn-primary">
        Список назначений для студентов
    </a>

    <div class="search_form">
        <form action="" method="get">
            <div class="input-group">
                <input type="text" name="search_course_field" class="form-control mb-2 mr-sm-2"
                       placeholder="Введите название курса" value="{{$searchParam}}">
                <button type="submit" class="btn btn-primary mb-2">Найти</button>
            </div>
        </form>
    </div>

    <div class="usersTable">
        @if (!empty($searchResult) && $searchResult->count())
            <table class="table table-striped table-modify">
                <table class="table table-striped table-modify">
                    <tr>
                        <th>Название курса</th>
                        <th>Автор</th>
                        <th class="center">Количество назначений</th>
                        <th>Дата создания</th>
                        <th class="center">Действие</th>
                    </tr>
                    @php($current = '')
                    @foreach($searchResult as $result)
                        @if ($current !== $result->name)
                            @php($current = $result->name)
                            <tr>
                                <td>{{$result->name ?? ''}}</td>
                                <td>{{$result->author->username ?? ''}}</td>
                                <td class="center">{{$result->appointments->count() ?? ''}}</td>
                                <td>{{$result->created_at}}</td>
                                <td class="center"><a class="btn btn-primary mb-3"
                                                      href="/target/courses/{{$result->id}}">Просмотреть список
                                        студентов</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
                <a href="{{$url}}" class="btn btn-primary mb-3">Назад</a>
                @elseif ($searchParam)
                    <p>Курс не найден</p>
                    <a href="{{$url}}" class="btn btn-primary mb-3">Назад</a>
                @endif

                @if (!empty($appointments))
                    <table class="table table-striped table-modify">
                        <tr>
                            <th>Название курса</th>
                            <th>Автор</th>
                            <th class="center">Количество назначений</th>
                            <th>Дата создания</th>
                            <th class="center">Действие</th>
                        </tr>
                        @php($current = '')
                        @foreach($appointments as $appointment)
                            @if ($current !== $appointment->course->name)
                                @php($current = $appointment->course->name)
                                <tr>
                                    <td>{{$appointment->course->name ?? '<>'}}</td>
                                    <td>{{$appointment->course->author->username ?? ''}}</td>
                                    <td class="center">{{$appointment->course->appointments->count() ?? ''}}</td>
                                    <td>{{$appointment->course->created_at}}</td>
                                    <td class="center"><a class="btn btn-primary mb-3"
                                                          href="/target/courses/{{$appointment->course->id}}">Просмотреть
                                            список
                                            студентов</a></td>
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
