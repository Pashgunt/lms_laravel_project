@extends('layout')

@section('content')
    <div class="target_user_list mt-3">
        <h4 class="mb-1">Список пользоватлей</h4>
        <span>
            <div class="mb-3">
                <form action="/target/user/search" method="get">
                    @if(isset($search_user))
                        @error('search_user')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="search_user_field" value="{{$search_user}}">
                    @else
                        <input type="text" name="search_user_field">
                    @endif
                    <input type="submit" value="Найти">
                </form>
            </div>
        </span>
        @if(isset($users))
            <div class="d-flex align-content-start flex-wrap">
                @foreach($users as $user)
                    <div class="btn btn-primary btn-sm mb-1 ms-1 user__draggable"
                         draggable="true" data-id="{{$user->id}}">{{$user->username}}</div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="target_courses_list">
        <h4 class="mb-1">Список курсов</h4>
        <span>
            <div class="mb-3">
                <form action="/target/course/search" method="get">
                    @if(isset($search_course))
                        <input type="text" name="search_course_field" value="{{$search_course}}">
                    @else
                        <input type="text" name="search_course_field">
                    @endif
                    <input type="submit" value="Найти">
                </form>
            </div>
        </span>
        @if(isset($courses))
            <div class="d-flex align-content-start flex-wrap">
                @foreach($courses as $course)
                    <div class="btn btn-primary btn-sm mb-1 ms-1 course__draggable"
                         draggable="true" data-id="{{$course->id}}">{{$course->name}}</div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col text-center bg-info p-2">Кому назначитть</div>
            <div class="col text-center bg-info p-2 ms-3">Какие курсы назначить</div>
        </div>
        <div class="row">
            <div class="col mx-auto border border-primary users__dragover" style="min-height: 200px"></div>
            <div class="col mx-auto border border-primary ms-3 courses__dragover" style="min-height: 200px"></div>
        </div>
    </div>

    <div class="btn btn-success col-md-4 offset-md-4 mt-3 button_target">Назначить</div>
@endsection

@section('script')
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/targetInterface.js"></script>
@endsection
