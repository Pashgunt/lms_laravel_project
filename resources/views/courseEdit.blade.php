@extends('layout')
@section('title', $title)

@section('content')
    @include('admin')

    @if(isset($course))
        {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('editCourse', $course ?? '') }}
        <h1>Редактирование курса</h1>
        <form action="/courses/{{$course->id}}/edit" method="post">
            @else
                {{ DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('createCourse') }}
                <h1>Создание курса</h1>
                <form action="/courses" method="post">
                    @endif
                    @csrf
                    @error('name')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" value="{{old('name', isset($course) ? $course->name : '')}}"
                           class="form-control form-control-lg"
                           name="name">
                    @error('description')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                    <textarea id="basic-wysiwyg"
                              name="description">{{old('description', isset($course) ? $course->description : '')}}</textarea>
                    <br/>
                    <input type="submit" value="Сохранить изменения" class="btn btn-success">
                </form>
                @endsection

            @section('script')
                <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
                <script src="/assets/js/wysiwyg.js"></script>
@endsection
