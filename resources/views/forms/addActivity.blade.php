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
            <select name="type_id" style="margin-bottom: 20px">
                @foreach($activitiesType as $type => $id)
                    <option value="{{$id}}">{{$type}}</option>
                @endforeach
            </select>
        </label> <br>
        <label>
            Заголовок -
            @error('activity_title')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" name="title" placeholder="Заголовок" style="margin-bottom: 20px" value="{{ old('activity_title') }}">
            @error('activity_text')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
            <textarea name="content" id="basic-wysiwyg" value="{{ old('activity_text') }}">
            </textarea>
        </label> <br>
        <a href="/courses/{{$courseId}}" class="btn btn-primary" style="margin-top: 20px">Назад</a>
        <input type="submit" name="add_activity" value="Добавить" class="btn btn-success" style="margin-top: 20px">
    </form>
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/js/wysiwyg.js"></script>
@endsection
