@extends('layout')
@section('title', 'Курс ' . $course->name)

@section('content')
    <br>
    <h1>{{$course->name}}</h1>
    <br>
    @foreach($course->activities as $activity)
        @if ($activity->item->activity_type_id === \App\Models\Activities::ACTIVITY_TEXT)
            @php ($additional = unserialize(json_decode($activity->item->additional)))
            <h4>{{$additional['title']}}</h4>
            {{$additional['content']}}
            <br>
            <br>
            <br>
        @endif
    @endforeach

    <form action="/course/{{$course->id}}/pass" method="post">
    @csrf
        <input type="submit" value="Завершить обучение" class="btn btn-success">
    </form>
@endsection
