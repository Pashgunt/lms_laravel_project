@extends('layout')
@section('title', 'LMS - управление назначениями')

@section('content')
    @include('admin')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="target_user_list mt-3">
        <h4 class="mb-1 fs-1">Список пользователей</h4>
        <span>
            <div class="mb-3">
                <div class = "users_error_message alert-danger"></div>
                <div class="d-flex position-relative">
                    @if(isset($search_user))
                        <input type="text" name="search_user_field" value="{{$search_user}}"
                               class="form-control form-control-md w-100 search_user_field">
                    @else
                        <input type="text" name="search_user_field"
                               class="form-control form-control-md w-100 search_user_field">
                    @endif
                    <div class="search_items_user position-absolute top-100 start-0 w-100 bg-light p-3"
                         style="z-index: 100">
                        <div class="position-relative">
                            <div class="position-absolute top-100 start-100 translate-middle close_search_users">
                                <img src="/assets/img/icons/close.png" alt=""
                                     style="object-fit: cover; width: 20px; height: 20px"></div>
                            <div class="search_items_user_wrapper position-relative"></div>
                        </div>

                    </div>

                </div>
            </div>
        </span>
        @if(isset($usersList))
            <div class="d-flex align-content-start flex-wrap target_user_append">
                @foreach($usersList as $user)
                    <div class="btn btn-primary btn-sm mb-1 ms-1 user__draggable"
                         draggable="true" data-id="{{$user->id}}">{{$user->username}}</div>
                @endforeach
            </div>
        @endif
        {{ $usersList->links('vendor.pagination.bootstrap-4') }}
    </div>
    <div class="target_courses_list">
        <h4 class="mb-1 fs-1">Список курсов</h4>
        <span>
            <div class="mb-3">
                <div class = "course_error_message alert-danger"></div>
                <div class="d-flex position-relative">
                    @if(isset($search_course))
                        <input type="text" name="search_course_field" value="{{$search_course}}"
                               class="form-control form-control-md w-100 search_course_field">
                    @else
                        <input type="text" name="search_course_field"
                               class="form-control form-control-md w-100 search_course_field">
                    @endif
                    <div class="search_items_course position-absolute top-100 start-0 w-100 bg-light p-3"
                         style="z-index: 100">
                        <div class="position-relative">
                            <div class="position-absolute top-100 start-100 translate-middle close_search_courses"
                            ><img src="/assets/img/icons/close.png" alt=""
                                  style="object-fit: cover; width: 20px; height: 20px"></div>
                            <div class="search_items_course_wrapper position-relative"></div>
                        </div>

                    </div>
                </div>
            </div>
        </span>
        @if(isset($coursesList))
            <div class="d-flex align-content-start flex-wrap target_course_append">
                @foreach($coursesList as $course)
                    <div class="btn btn-primary btn-sm mb-1 ms-1 course__draggable"
                         draggable="true" data-id="{{$course->id}}">{{$course->name}}</div>
                @endforeach
            </div>
        @endif
        {{ $coursesList->links('vendor.pagination.bootstrap-4') }}
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col text-center bg-info p-2">Кому назначить</div>
            <div class="col text-center bg-info p-2 ms-3">Какие курсы назначить</div>
        </div>
        <div class="row">
            <div class="col mx-auto border border-primary users__dragover" style="min-height: 200px"></div>
            <div class="col mx-auto border border-primary ms-3 courses__dragover" style="min-height: 200px"></div>
        </div>
    </div>
    <br>
    <a class="btn btn-success col-md-4 offset-md-4 mt-3 button_target">Назначить</a>
    <a href="/target" class="btn btn-primary mt-3 mb-3 block col-md-2 offset-md-5">Вернуться к списку назначений</a>
    <div class="success_target col-md-4 offset-md-4 mt-3 alert alert-secondary text-center"></div>
@endsection

@section('script')
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/targetInterface.js"></script>
@endsection
