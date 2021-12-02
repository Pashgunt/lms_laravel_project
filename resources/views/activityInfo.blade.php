@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
@endsection

@section ('content')
    @include('admin')
    <h4>{{$data['title']}}</h4>
    <p>{!! $data['content'] !!}</p>
    <a href="/courses/activity/{{$activities->getKey()}}/edit-page" class="btn btn-warning">Редактировать</a>
    <a href="/courses/{{$courseId}}" class="btn btn-primary">Назад</a>
@endsection
