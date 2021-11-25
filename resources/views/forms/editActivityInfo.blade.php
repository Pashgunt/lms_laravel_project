@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
@endsection

@section ('content')
    <h4>Редактирование элемента курса</h4>
    <form action="/courses/activity/{{$activity->id}}/edit" method="post">
        @csrf
        <label>
            Заголовок <br>
            <textarea name="activity_title" cols="40" rows="1">{{$activity->activity_title}}</textarea>
        </label><br>
        <label style="margin-top: 20px">
            Контент
            <textarea name="activity_text" id="basic-wysiwyg">
                {{$activity->text}}
            </textarea>
        </label><br>
        <label style="margin-top: 20px">
            Ссылка на контент -
            <input type="text" name="activity_link" value="{{$activity->link}}">
        </label><br>
        <a href="/courses/activity/{{$activity->id}}" class="btn btn-primary" style="margin-top: 20px">Назад</a>
        <input type="submit" name="edit_activity" value="Сохранить" class="btn btn-success" style="margin-top: 20px">
    </form>
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/js/wysiwyg.js"></script>
@endsection
