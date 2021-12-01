@extends('layout')
@section('title', 'LMS - управление назначениями')

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')
    {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('target') }}
    <h1>Список назначений по курсам</h1>

    <a href="/target-interface/1/1" class="btn btn-primary">
        Создать назначение
    </a>

    <a href="/target/students" class="btn btn-primary">
        Список назначений для студентов
    </a>

    <div class="search_form">
        <form action="" method="get">
            <div class="input-group">
                <input type="text" name="search_course_field" class="form-control mb-2 mr-sm-2"
                       placeholder="Введите параметр запроса" value="{{$searchParam}}">
                <button type="submit" class="btn btn-primary mb-2">Найти</button>
            </div>
        </form>
    </div>

    <div class="usersTable">
        @if (!empty($searchResult))
            <table class="table table-striped table-modify">
                @foreach($searchResult as $result)
                    <tr>
                        <th colspan="3" class="center">
                            Курс: {{$result->name ?? '<без имени>'}}
                            (назначений: {{$result->appointments->count()}})
                        </th>
                    @if($result->appointments->count())
                        @foreach($result->appointments as $appointment)
                            <tr>
                                <td>{{$appointment->student->username ?? '<без имени>'}}</td>
                                <td width="10%">
                                    <a class="confirm_delete btn btn-danger"
                                       href="/target/{{$appointment->id}}/destroy">Удалить</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tr>
                        @endforeach
            </table>
        @elseif ($searchParam)
            <p>Курс не найден</p>
        @endif

        @if (!empty($appointments))
            <table class="table table-striped table-modify">
                @php($current = '')
                @foreach($appointments as $appointment)
                    @if ($current !== $appointment->course->name)
                        @php($current = $appointment->course->name)
                        <tr>
                            <th colspan="3" class="center">Курс: {{$appointment->course->name ?? '<без названия>'}}
                                (назначений: {{$appointment->course->appointments->count()}})</th>
                        </tr>
                    @endif
                    <tr>
                        <td>{{$appointment->student->username ?? '<без имени>'}}</td>
                        <td width="10%">
                            <a class="confirm_delete btn btn-danger"
                               href="/target/{{$appointment->id}}/destroy">Удалить</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $appointments->links('vendor.pagination.bootstrap-4') }}
            <a href="/" class="btn btn-primary mb-3">На главную</a>
        @endif
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
