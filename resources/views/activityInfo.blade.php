@extends('layout')

@section('style')
    <link rel="stylesheet" href="/assets/css/courseInfo.css">
@endsection

@section ('content')
    <h4>{{$activity->activity_title}}</h4>
    <p>{!! $activity->text !!}</p>
    <a href="/courses/{{$activity->course_id}}" class="btn btn-primary">Назад</a>
@endsection
