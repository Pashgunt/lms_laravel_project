@extends('layout')
@section('title', 'Курс ' . $course->name)

@section('content')
    <br>
    <h1>{{$course->name}}</h1>

@endsection
