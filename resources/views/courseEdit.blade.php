@extends('layout')

@section('content')
    @if(isset($course))
        <h4>Редактирование курса</h4>
    @else
        <h4>Создание курса</h4>
    @endif
    @if(isset($course))
        <form action="/courses/{{$course->id}}/edit" method="post">
            @csrf
            @error('nameCourse')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" value="{{$course->name}}" class="form-control form-control-lg" name="nameCourse">
            @error('descCourse')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
            <textarea id="basic-wysiwyg" name = "descCourse">{{$course->description}}</textarea>
            <input type="submit" value="Изменить" class="btn btn-success">
        </form>
    @else
        <form action="/courses/create" method="get">
            @csrf
            <input placeholder="Название курса" type="text" value="" class="form-control form-control-lg" name="nameCourse" >
            <textarea placeholder="Описание курса" id="basic-wysiwyg" name="descCourse"></textarea>
            <br>
            <input type="submit" value="Сохранить" class="btn btn-success">
        </form>
    @endif
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/js/wysiwyg.js"></script>
@endsection
