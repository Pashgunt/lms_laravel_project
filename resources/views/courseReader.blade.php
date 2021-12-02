@extends('layout')
@section('title', 'Курс ' . $course->name)

@section('content')
    <h1>{{$course->name}}</h1>

    @foreach($course->)

@endsection
