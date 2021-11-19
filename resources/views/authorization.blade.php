@include ('layout')

@section ('content')
    <section class="registration">
        <section class="registration__wrapper _container">
            <form action="/" method="post">
                @csrf
                <span class="registration__title _title">Авторизация</span>
                <label class="_title">Логин <br><input name="login" type="text"></label>
                <label class="_title"> Пароль <a href="/recovery">Забыли пароль?</a><br>
                    <input name="password" type="password">
                </label>
                <input type="submit" value="Авторизоваться" name="authUser">
            </form>
        </section>
    </section>
@endsection
