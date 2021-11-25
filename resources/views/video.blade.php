@extends('layout')

@section('style')
    <link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    <section>
        <video id="demo_video" class="video-js" controls width="1024" height="768">
            <source src="assets/video/test_video.mp4" type="video/mp4">
        </video>
    </section>
@endsection
