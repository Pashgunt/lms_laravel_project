@extends("layout")
@section('style')
    <link rel="stylesheet" href="/assets/css/usersList.css">
@endsection

@section('content')
    <section class="registration__wrapper _container">
        <h3>Технические неполадки</h3>
        <div><a href="{{Redirect::back()->getTargetUrl()}}">Вернуться на предыдущую страницу</a></div>
    </section>
@endsection
