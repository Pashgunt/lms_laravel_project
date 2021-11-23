@extends('layout')

@section('style')
    <link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    <section>
        <video
            id="my-video"
            class="video-js"
            controls
            preload="auto"
            width="1024"
            height="768"
            data-setup="{}">

            <source src="assets/video/test_video.mp4" type="video/mp4"/>
            <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank"
                >supports HTML5 video</a
                >
            </p>
        </video>

        <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
    </section>
@endsection
