<div class="admin_content">
    @if (mb_strtolower(Auth::user()->role->role_name) === \App\Models\Role::ROLE_ADMIN)
    <a href="/users/list" class="header__registration" role="button">Управление пользователями</a>
    @endif
    <a href="/courses" class="header__registration" role="button">Управление курсами</a>
    <a href="/target" class="header__registration" role="button">Управление назначениями</a>
</div>


