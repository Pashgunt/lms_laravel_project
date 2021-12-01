@extends('layout')
@section('title', $title)

@section('content')
    @include('admin')

    @if(isset($course))
        {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('editCourse', $course) }}
        <h1>Редактирование курса</h1>
        <form action="/courses/{{$course->id}}/edit" method="post">
            @else
                {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('createCourse') }}
                <h1>Создание курса</h1>
                <form action="/courses" method="post">
                    @endif
                    @csrf
                    @error('nameCourse')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" value="{{isset($course->name)? $course->name : old('nameCourse')}}"
                           class="form-control form-control-lg"
                           name="nameCourse">
                    @error('descCourse')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <textarea id="basic-wysiwyg"
                              name="descCourse">{{isset($course->description)? $course->description : old('descCourse')}}</textarea>
                    <br/>
                    <input type="submit" value="Сохранить изменения" class="btn btn-success">
                </form>
                @endsection

            @section('script')
                <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
                <script src="/assets/js/wysiwyg.js"></script>
@endsection
