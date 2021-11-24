@extends('layout')

@section('content')
    <h4>Редактирование курса</h4>
    @if(isset($course))
        <form action="/courses/{{$course->id}}/edit" method="post">
            <input type="text" value="{{$course->name}}" class="form-control form-control-lg">
            <input type="text" value="{{$course->author}}" class="form-control form-control-lg">
            <textarea id="basic-wysiwyg">{{$course->description}}</textarea>
            <input type="submit" value="Изменить" class="btn btn-success">
        </form>
    @endif
@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/js/wysiwyg.js"></script>
@endsection
