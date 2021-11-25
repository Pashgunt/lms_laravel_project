@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
@endsection

@section ('content')
    <h4>Добавление активити элемента</h4>
    <form action="/courses/{{$courseId}}/activity/add" method="post">
        <label>
            Заголовок -
            <input type="text" name="activityTitle" placeholder="Заголовок">
            <textarea name="activityText" id="basic-wysiwyg">
            </textarea>
        </label>
    </form>
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/js/wysiwyg.js"></script>
@endsection
