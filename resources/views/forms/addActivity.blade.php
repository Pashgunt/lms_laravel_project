@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
    <link rel="stylesheet" href="/assets/css/test-constructor.css">
@endsection

@section ('content')
    <h4>Добавление элемента курса</h4>
    <form action="/courses/activity/{{$courseId}}/add" method="post">
        @csrf
        <div class="activity_form">
            @include($addForm)
            <a href="/courses/{{$courseId}}" class="btn btn-primary" style="margin-top: 20px">Назад</a>
            <input type="hidden" name="activity_type" value="{{$activityType}}">
            <input type="submit" value="Добавить" class="btn btn-success" style="margin-top: 20px">
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/js/wysiwyg.js"></script>
@endsection
