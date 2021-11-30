@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
@endsection

@section ('content')
    @include('admin')
    @foreach($activities as $activity)
        <h4>{{$activity->title}}</h4>
        <p>{!! $activity->content !!}</p>
        <a href="/courses/activity/{{$activity->id}}/edit-page" class="btn btn-warning">Редактировать</a>
        <a href="/courses/{{$courseId}}" class="btn btn-primary">Назад</a>
    @endforeach
@endsection
