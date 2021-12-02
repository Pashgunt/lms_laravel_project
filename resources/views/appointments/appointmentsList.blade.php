@extends('layout')

@if ($subject === 'course')
    @section('title', 'LMS - список назначений для курсов')
@else
    @section('title', 'LMS - список назначений для студентов')
@endif

@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    @include('admin')
    @if ($subject === 'course')
        {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('target') }}
        <h1>Список назначений по курсам</h1>
        <a href="/target/students" class="btn btn-warning">Список назначений для студентов</a>
    @else
        {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('students') }}
        <h1>Список назначений для студентов</h1>
        <a href="/target" class="btn btn-warning">Список назначений по курсам</a>
    @endif

    <a href="/target-interface" class="btn btn-primary">Создать назначение</a>

    <div class="search_form">
        <form action="" method="get">
            <div class="input-group">
                <input type="text" name="search_course_field" class="form-control mb-2 mr-sm-2"
                       placeholder="{{$subject === 'course' ? 'Введите название курса' :  'Введите данные пользователя'}}"
                       value="{{$searchParam}}">
                <button type="submit" class="btn btn-primary mb-2">Найти</button>
            </div>
        </form>
    </div>

    <div class="usersTable">
        @if (!empty($searchResult) && $searchResult->count())
            @if ($subject === 'course')
                @include('appointments.coursesTable', ['appointments' => $searchResult])
            @else
                @include('appointments.studentsTable', ['appointments' => $searchResult])
            @endif
            <a href="{{$url}}" class="btn btn-primary mb-3">Назад</a>
        @elseif ($searchParam)
            @if ($subject === 'course')
                <p>Курс не найден</p>
            @else
                <p>Студент не найден</p>
            @endif
            <a href="{{$url}}" class="btn btn-primary mb-3">Назад</a>
        @endif

        @if (!empty($appointments))
            @if ($subject === 'course')
                @include('appointments.coursesTable', ['appointments' => $appointments])
            @else
                @include('appointments.studentsTable', ['appointments' => $appointments])
            @endif
            {{ $appointments->links('vendor.pagination.bootstrap-4') }}
            <a href="/" class="btn btn-primary mb-3">На главную</a>
        @endif
    </div>
    <script src="/assets/js/delete-confirm.js"></script>
@endsection
