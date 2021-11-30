@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
@endsection

@section ('content')
    <h4>Редактирование элемента курса</h4>
    @foreach($activities as $activity)
        <form action="/courses/activity/{{$activity->id}}/edit" method="post">
            @csrf
            <label>
                Заголовок <br>
                @error('activity_title')
                <div class="alert-danger">{{ $message }}</div>
                @enderror
                <textarea name="title" cols="40"
                          rows="1">{{old('title', $activity->title)}}</textarea>
            </label>
            <br>
            <label style="margin-top: 20px">
                Контент
                @error('activity_text')
                <div class="alert-danger">{{ $message }}</div>
                @enderror
                <textarea name="content"
                          id="basic-wysiwyg">{{old('content', $activity->content)}}</textarea>
            </label><br>
            <a href="/courses/activity/{{$activity->id}}" class="btn btn-primary" style="margin-top: 20px">Назад</a>
            <input type="submit" name="edit_activity" value="Сохранить" class="btn btn-success"
                   style="margin-top: 20px">
        </form>
    @endforeach
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/js/wysiwyg.js"></script>
@endsection
