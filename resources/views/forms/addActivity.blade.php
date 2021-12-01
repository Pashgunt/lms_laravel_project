@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
@endsection

@section ('content')
    <h4>Добавление элемента курса</h4>
    <form action="/courses/{{$courseId}}/activity/add" method="post">
        @csrf
        <label>
            Тип -
            <select name="type_id" style="margin-bottom: 20px" class="activity_add_form">
                @foreach($activitiesType as $type)
                    <option value="{{$type->id}}">{{$type->name_rus}}</option>
                @endforeach
            </select>
            <button class="accept_form" type="button">Применить</button>
        </label> <br>
        <div class="activity_form">
            @include('forms/activities/addTextActivity')
            @include('forms/activities/addTestActivity')
            @include('forms/activities/addVideoActivity')
            @include('forms/activities/addImageActivity')
        </div>
        <br>
        <a href="/courses/{{$courseId}}" class="btn btn-primary" style="margin-top: 20px">Назад</a>
        <input type="submit" name="add_activity" value="Добавить" class="btn btn-success" style="margin-top: 20px">
    </form>
    <script src="/assets/js/ActivitiesAddForm.js"></script>
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/js/wysiwyg.js"></script>
@endsection
